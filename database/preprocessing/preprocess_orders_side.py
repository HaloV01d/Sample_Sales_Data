import pandas as pd
from pathlib import Path

# ============================================================
# Paths
# ============================================================

INPUT_FILE = Path("database/original_csv/sales_data_sample.csv")
OUTPUT_DIR = Path("database/processed_csv")
CUSTOMER_FILE = OUTPUT_DIR / "customer.csv"

OUTPUT_DIR.mkdir(parents=True, exist_ok=True)

# ============================================================
# Read original CSV
# ============================================================

df = pd.read_csv(INPUT_FILE, encoding="latin1")

# Normalize column names
df.columns = df.columns.str.lower()

# Clean whitespace in text columns
for col in df.columns:
    if df[col].dtype == "object":
        df[col] = df[col].str.strip()

# ============================================================
# PRODUCT_LINE
# ============================================================

product_line = (
    df[["productline"]]
    .drop_duplicates()
    .sort_values("productline")
    .reset_index(drop=True)
)

product_line.insert(0, "productline_id", range(1, len(product_line) + 1))

product_line = product_line.rename(columns={
    "productline": "productline_name"
})

product_line.to_csv(OUTPUT_DIR / "product_line.csv", index=False)

# Add productline_id back into main dataframe
df = df.merge(
    product_line,
    left_on="productline",
    right_on="productline_name",
    how="left"
)

# ============================================================
# PRODUCT
# Depends on PRODUCT_LINE
# ============================================================

product = (
    df[["productcode", "msrp", "productline_id"]]
    .drop_duplicates()
    .sort_values("productcode")
    .reset_index(drop=True)
)

product.to_csv(OUTPUT_DIR / "product.csv", index=False)

# ============================================================
# CUSTOMER
# Assumes customer.csv is already preprocessed
# ============================================================

customer = pd.read_csv(CUSTOMER_FILE)

# Normalize customer.csv column names
customer.columns = customer.columns.str.lower()

# Clean whitespace in customer text columns
for col in customer.columns:
    if customer[col].dtype == "object":
        customer[col] = customer[col].str.strip()

required_customer_cols = {"customer_id", "customername", "phone"}
missing_cols = required_customer_cols - set(customer.columns)

if missing_cols:
    raise ValueError(
        f"customer.csv is missing required columns: {missing_cols}"
    )

# Make sure customername + phone uniquely identifies each customer
duplicate_customers = customer.duplicated(
    subset=["customername", "phone"]
).sum()

if duplicate_customers > 0:
    raise ValueError(
        f"customer.csv has {duplicate_customers} duplicate customername + phone combinations."
    )

# ============================================================
# ORDERS
# Depends on CUSTOMER
# ============================================================

orders_source = (
    df[[
        "ordernumber",
        "orderdate",
        "status",
        "qtr_id",
        "month_id",
        "year_id",
        "customername",
        "phone"
    ]]
    .drop_duplicates()
    .sort_values("ordernumber")
    .reset_index(drop=True)
)

orders = orders_source.merge(
    customer[["customer_id", "customername", "phone"]],
    on=["customername", "phone"],
    how="left"
)

missing_customer_ids = orders["customer_id"].isna().sum()

if missing_customer_ids > 0:
    unmatched_orders = orders[orders["customer_id"].isna()]

    print("Some orders could not be matched to a customer:")
    print(unmatched_orders[[
        "ordernumber",
        "customername",
        "phone"
    ]].head())

    raise ValueError(
        f"{missing_customer_ids} orders are missing customer_id."
    )

# Convert order date to MySQL-friendly format
orders["orderdate"] = pd.to_datetime(
    orders["orderdate"],
    errors="coerce"
).dt.strftime("%Y-%m-%d")

orders = orders[[
    "ordernumber",
    "orderdate",
    "status",
    "qtr_id",
    "month_id",
    "year_id",
    "customer_id"
]]

orders.to_csv(OUTPUT_DIR / "orders.csv", index=False)

# ============================================================
# ORDER_LINE
# Depends on ORDERS and PRODUCT
# ============================================================

order_line = (
    df[[
        "ordernumber",
        "orderlinenumber",
        "quantityordered",
        "priceeach",
        "sales",
        "productcode",
        "dealsize"
    ]]
    .drop_duplicates()
    .sort_values(["ordernumber", "orderlinenumber"])
    .reset_index(drop=True)
)

order_line.to_csv(OUTPUT_DIR / "order_line.csv", index=False)

# ============================================================
# Validation
# ============================================================

print("\nGenerated files:")
print(f"- product_line.csv: {len(product_line)} rows")
print(f"- product.csv: {len(product)} rows")
print(f"- orders.csv: {len(orders)} rows")
print(f"- order_line.csv: {len(order_line)} rows")

print("\nValidation:")

duplicate_productline_ids = product_line.duplicated(
    subset=["productline_id"]
).sum()

print(f"Duplicate PRODUCT_LINE PKs: {duplicate_productline_ids}")

duplicate_productcodes = product.duplicated(
    subset=["productcode"]
).sum()

print(f"Duplicate PRODUCT PKs: {duplicate_productcodes}")

missing_productline_refs = (
    set(product["productline_id"]) -
    set(product_line["productline_id"])
)

print(f"Missing PRODUCT_LINE references in PRODUCT: {len(missing_productline_refs)}")

duplicate_ordernumbers = orders.duplicated(
    subset=["ordernumber"]
).sum()

print(f"Duplicate ORDERS PKs: {duplicate_ordernumbers}")

duplicate_orderline_pks = order_line.duplicated(
    subset=["ordernumber", "orderlinenumber"]
).sum()

print(f"Duplicate ORDER_LINE PKs: {duplicate_orderline_pks}")

missing_order_refs = (
    set(order_line["ordernumber"]) -
    set(orders["ordernumber"])
)

print(f"Missing ORDERS references in ORDER_LINE: {len(missing_order_refs)}")

missing_product_refs = (
    set(order_line["productcode"]) -
    set(product["productcode"])
)

print(f"Missing PRODUCT references in ORDER_LINE: {len(missing_product_refs)}")