# MySQL Password Reset v4 - Direct mysqld approach
# MUST be run as Administrator

$mysqldPath = "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqld.exe"
$mysqlPath = "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe"
$iniPath = "C:\ProgramData\MySQL\MySQL Server 8.0\my.ini"

Write-Host "=== MySQL Password Reset v4 ===" -ForegroundColor Cyan

# Step 1: Stop MySQL service completely
Write-Host "`n[1/5] Stopping MySQL80 service..." -ForegroundColor Yellow
Stop-Service MySQL80 -Force -ErrorAction SilentlyContinue
Start-Sleep 3
# Kill any remaining mysqld processes
Get-Process mysqld -ErrorAction SilentlyContinue | Stop-Process -Force
Start-Sleep 3
Write-Host "  Service stopped"

# Step 2: Start mysqld directly with skip-grant-tables (NOT as service)
Write-Host "`n[2/5] Starting mysqld directly with --skip-grant-tables..." -ForegroundColor Yellow
$proc = Start-Process -FilePath $mysqldPath -ArgumentList "--defaults-file=`"$iniPath`"", "--skip-grant-tables", "--shared-memory" -PassThru -WindowStyle Hidden
Write-Host "  mysqld started (PID: $($proc.Id))"
Write-Host "  Waiting 15 seconds for MySQL to initialize..."
Start-Sleep 15

# Check if process is still running
if ($proc.HasExited) {
    Write-Host "  ERROR: mysqld exited prematurely!" -ForegroundColor Red
    Write-Host "  Trying without --shared-memory..."
    $proc = Start-Process -FilePath $mysqldPath -ArgumentList "--defaults-file=`"$iniPath`"", "--skip-grant-tables" -PassThru -WindowStyle Hidden
    Start-Sleep 15
}

# Step 3: Reset password
Write-Host "`n[3/5] Connecting and resetting password..." -ForegroundColor Yellow

# Try TCP connection first
Write-Host "  Trying TCP connection (127.0.0.1)..."
& $mysqlPath --host=127.0.0.1 --port=3306 -u root -e "FLUSH PRIVILEGES; ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123'; FLUSH PRIVILEGES;" 2>&1
$result1 = $LASTEXITCODE

if ($result1 -ne 0) {
    Write-Host "  TCP failed, trying localhost..."
    & $mysqlPath --host=localhost -u root -e "FLUSH PRIVILEGES; ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123'; FLUSH PRIVILEGES;" 2>&1
    $result1 = $LASTEXITCODE
}

if ($result1 -ne 0) {
    Write-Host "  Trying with --protocol=PIPE..."
    & $mysqlPath --protocol=PIPE -u root -e "FLUSH PRIVILEGES; ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123'; FLUSH PRIVILEGES;" 2>&1
    $result1 = $LASTEXITCODE
}

if ($result1 -ne 0) {
    Write-Host "  Trying with --protocol=MEMORY..."
    & $mysqlPath --protocol=MEMORY --shared-memory-base-name=MYSQL -u root -e "FLUSH PRIVILEGES; ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123'; FLUSH PRIVILEGES;" 2>&1
    $result1 = $LASTEXITCODE
}

if ($result1 -eq 0) {
    Write-Host "  Password reset SUCCEEDED!" -ForegroundColor Green
} else {
    Write-Host "  All connection methods FAILED" -ForegroundColor Red
    Write-Host "  Checking if mysqld is running..."
    Get-Process mysqld -ErrorAction SilentlyContinue | Format-Table Id, ProcessName, StartTime
    netstat -an | Select-String "3306"
}

# Step 4: Kill mysqld
Write-Host "`n[4/5] Stopping mysqld..." -ForegroundColor Yellow
Stop-Process -Id $proc.Id -Force -ErrorAction SilentlyContinue
Get-Process mysqld -ErrorAction SilentlyContinue | Stop-Process -Force
Start-Sleep 5
Write-Host "  mysqld stopped"

# Step 5: Start MySQL service normally
Write-Host "`n[5/5] Starting MySQL80 service..." -ForegroundColor Yellow
Start-Service MySQL80
Start-Sleep 5
Write-Host "  Service started"

# Test
Write-Host "`n=== Testing connection ===" -ForegroundColor Cyan
& $mysqlPath -u root -ptest123 -e "SELECT 'Password reset successful!' AS result;" 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "`n=== SUCCESS ===" -ForegroundColor Green
} else {
    Write-Host "`n=== FAILED ===" -ForegroundColor Red
    Write-Host "Debugging info:" -ForegroundColor Yellow
    Write-Host "  MySQL service status:"
    Get-Service MySQL80
    Write-Host "  Port 3306:"
    netstat -an | Select-String "3306"
}

Write-Host "`nPress Enter to close..."
Read-Host
