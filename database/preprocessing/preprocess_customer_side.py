import pandas as pd
from pathlib import Path

# ============================================================
# Paths
# ============================================================

INPUT_FILE = Path("database/original_csv/sales_data_sample.csv")
OUTPUT_DIR = Path("database/processed_csv")

OUTPUT_DIR.mkdir(parents=True, exist_ok=True)

# ============================================================
# Read original CSV
# ============================================================

df = pd.read_csv(INPUT_FILE, encoding="cp1252")

# Normalize column names just to be safe
df.columns = df.columns.str.upper()

# Clean whitespace in text columns
for col in df.columns:
    if df[col].dtype == "object":
        df[col] = df[col].str.strip()

# ============================================================
# ADDRESS
# ============================================================

address_columns = [
    "ADDRESSLINE1",
    "ADDRESSLINE2",
    "CITY",
    "STATE",
    "POSTALCODE",
    "COUNTRY",
    "TERRITORY"
]

address_table = (
    df[address_columns]
    .drop_duplicates()
    .reset_index(drop=True)
)

address_table.insert(0, "ADDRESS_ID", range(1, len(address_table) + 1))

address_table.to_csv(OUTPUT_DIR / "address.csv", index=False, encoding="utf-8")

# Add ADDRESS_ID back into df
df = df.merge(
    address_table,
    on=address_columns,
    how="left"
)

# ============================================================
# CUSTOMER
# ============================================================

customer_table = (
    df[["CUSTOMERNAME", "PHONE", "ADDRESS_ID"]]
    .drop_duplicates()
    .reset_index(drop=True)
)

customer_table.insert(0, "CUSTOMER_ID", range(1, len(customer_table) + 1))

customer_table.to_csv(OUTPUT_DIR / "customer.csv", index=False, encoding="utf-8")

# Add CUSTOMER_ID back into df
df = df.merge(
    customer_table,
    on=["CUSTOMERNAME", "PHONE", "ADDRESS_ID"],
    how="left"
)

# ============================================================
# CONTACT
# ============================================================

contact_table = (
    df[[
        "CONTACTFIRSTNAME",
        "CONTACTLASTNAME",
        "CUSTOMER_ID"
    ]]
    .drop_duplicates()
    .reset_index(drop=True)
)

contact_table.insert(0, "CONTACT_ID", range(1, len(contact_table) + 1))

contact_table = contact_table[[
    "CONTACT_ID",
    "CONTACTFIRSTNAME",
    "CONTACTLASTNAME",
    "CUSTOMER_ID"
]]

contact_table.to_csv(OUTPUT_DIR / "contact.csv", index=False, encoding="utf-8")

# ============================================================
# DOMESTIC_CUSTOMER / INTERNATIONAL_CUSTOMER
# ============================================================

customer_with_country = customer_table.merge(
    address_table[["ADDRESS_ID", "COUNTRY"]],
    on="ADDRESS_ID",
    how="left"
)

domestic_customer = (
    customer_with_country[customer_with_country["COUNTRY"] == "USA"]
    [["CUSTOMER_ID"]]
    .drop_duplicates()
    .reset_index(drop=True)
)

international_customer = (
    customer_with_country[customer_with_country["COUNTRY"] != "USA"]
    [["CUSTOMER_ID"]]
    .drop_duplicates()
    .reset_index(drop=True)
)

domestic_customer.to_csv(
    OUTPUT_DIR / "domestic_customer.csv",
    index=False,
    encoding="utf-8"
)

international_customer.to_csv(
    OUTPUT_DIR / "international_customer.csv",
    index=False,
    encoding="utf-8"
)

# ============================================================
# Validation
# ============================================================

print("\nGenerated files:")
print(f"- address.csv: {len(address_table)} rows")
print(f"- customer.csv: {len(customer_table)} rows")
print(f"- contact.csv: {len(contact_table)} rows")
print(f"- domestic_customer.csv: {len(domestic_customer)} rows")
print(f"- international_customer.csv: {len(international_customer)} rows")

print("\nValidation:")

duplicate_address_ids = address_table.duplicated(subset=["ADDRESS_ID"]).sum()
duplicate_customer_ids = customer_table.duplicated(subset=["CUSTOMER_ID"]).sum()
duplicate_contact_ids = contact_table.duplicated(subset=["CONTACT_ID"]).sum()

print(f"Duplicate ADDRESS PKs: {duplicate_address_ids}")
print(f"Duplicate CUSTOMER PKs: {duplicate_customer_ids}")
print(f"Duplicate CONTACT PKs: {duplicate_contact_ids}")

missing_customer_address_refs = (
    set(customer_table["ADDRESS_ID"]) -
    set(address_table["ADDRESS_ID"])
)

print(f"Missing ADDRESS references in CUSTOMER: {len(missing_customer_address_refs)}")

missing_contact_customer_refs = (
    set(contact_table["CUSTOMER_ID"]) -
    set(customer_table["CUSTOMER_ID"])
)

print(f"Missing CUSTOMER references in CONTACT: {len(missing_contact_customer_refs)}")

domestic_ids = set(domestic_customer["CUSTOMER_ID"])
international_ids = set(international_customer["CUSTOMER_ID"])
customer_ids = set(customer_table["CUSTOMER_ID"])

missing_inheritance_ids = (
    customer_ids -
    domestic_ids -
    international_ids
)

overlapping_inheritance_ids = domestic_ids & international_ids

print(f"Customers missing inheritance category: {len(missing_inheritance_ids)}")
print(f"Customers in both domestic and international: {len(overlapping_inheritance_ids)}")