@echo off
REM ========================================
REM Sales Data Web Application Deployment
REM Automated deployment to XAMPP
REM ========================================

echo.
echo ========================================
echo  Sales Data Web App - XAMPP Deployment
echo ========================================
echo.

REM Check if XAMPP directory exists
if not exist "C:\xampp\htdocs\" (
    echo [ERROR] XAMPP htdocs directory not found at C:\xampp\htdocs\
    echo.
    echo Please install XAMPP or update the path in this script.
    echo Download XAMPP from: https://www.apachefriends.org
    pause
    exit /b 1
)

echo [1/3] Checking XAMPP installation...
echo      XAMPP directory found: C:\xampp\htdocs\
echo.

REM Create target directory
echo [2/3] Creating deployment directory...
if not exist "C:\xampp\htdocs\Sample_Sales_Data\" (
    mkdir "C:\xampp\htdocs\Sample_Sales_Data"
    echo      Created: C:\xampp\htdocs\Sample_Sales_Data\
) else (
    echo      Directory already exists: C:\xampp\htdocs\Sample_Sales_Data\
)
echo.

REM Copy files
echo [3/3] Copying files...

REM Copy src folder
echo      - Copying src folder...
xcopy /E /I /Y "src" "C:\xampp\htdocs\Sample_Sales_Data\src\"

REM Copy diagram folder
echo      - Copying diagram folder...
xcopy /E /I /Y "diagram" "C:\xampp\htdocs\Sample_Sales_Data\diagram\"

REM Copy database folder (for setup.php to access SQL files)
echo      - Copying database folder...
xcopy /E /I /Y "database" "C:\xampp\htdocs\Sample_Sales_Data\database\"

REM Copy documentation
echo      - Copying documentation...
copy /Y "README.md" "C:\xampp\htdocs\Sample_Sales_Data\"
copy /Y "QUICKSTART.md" "C:\xampp\htdocs\Sample_Sales_Data\"

echo.
echo ========================================
echo  Deployment Complete!
echo ========================================
echo.
echo Files have been copied to:
echo   C:\xampp\htdocs\Sample_Sales_Data\
echo.
echo Next Steps:
echo   1. Start Apache and MySQL in XAMPP Control Panel
echo   2. Open browser and go to:
echo      http://localhost/Sample_Sales_Data/src/setup.php
echo   3. Wait for automatic database setup to complete
echo   4. Access the application at:
echo      http://localhost/Sample_Sales_Data/src/
echo.
echo Would you like to open XAMPP Control Panel? (Y/N)
set /p openxampp=

if /i "%openxampp%"=="Y" (
    if exist "C:\xampp\xampp-control.exe" (
        start "" "C:\xampp\xampp-control.exe"
        echo XAMPP Control Panel opened.
    ) else (
        echo XAMPP Control Panel not found at default location.
        echo Please open it manually from your XAMPP installation folder.
    )
)

echo.
echo Would you like to open the application in your browser? (Y/N)
set /p openbrowser=

if /i "%openbrowser%"=="Y" (
    start "" "http://localhost/Sample_Sales_Data/src/"
    echo Browser opened.
)

echo.
echo Press any key to exit...
pause > nul
