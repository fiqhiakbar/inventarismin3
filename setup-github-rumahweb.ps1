# 🚀 PowerShell Script Setup GitHub-RumahWeb Integration
# Author: AI Assistant
# Version: 1.0

Write-Host "🔄 Setting up GitHub-RumahWeb Integration..." -ForegroundColor Green
Write-Host "==============================================" -ForegroundColor Green

# Function to print colored output
function Write-Status {
    param([string]$Message)
    Write-Host "[INFO] $Message" -ForegroundColor Green
}

function Write-Warning {
    param([string]$Message)
    Write-Host "[WARNING] $Message" -ForegroundColor Yellow
}

function Write-Error {
    param([string]$Message)
    Write-Host "[ERROR] $Message" -ForegroundColor Red
}

function Write-Step {
    param([string]$Message)
    Write-Host "[STEP] $Message" -ForegroundColor Blue
}

# Step 1: Check if Git is installed
Write-Step "1. Checking Git installation..."
try {
    $gitVersion = git --version
    Write-Status "Git is installed: $gitVersion"
} catch {
    Write-Error "Git is not installed. Please install Git first."
    Write-Host "Download from: https://git-scm.com/download/win" -ForegroundColor Cyan
    exit 1
}

# Step 2: Check if SSH key already exists
Write-Step "2. Checking existing SSH keys..."
$sshKeyPath = "$env:USERPROFILE\.ssh\rumahweb_key"

if (Test-Path $sshKeyPath) {
    Write-Warning "SSH key already exists at $sshKeyPath"
    $overwrite = Read-Host "Do you want to overwrite it? (y/N)"
    if ($overwrite -eq "y" -or $overwrite -eq "Y") {
        Remove-Item $sshKeyPath -Force -ErrorAction SilentlyContinue
        Remove-Item "$sshKeyPath.pub" -Force -ErrorAction SilentlyContinue
    } else {
        Write-Status "Using existing SSH key"
    }
}

# Step 3: Generate SSH key if needed
if (-not (Test-Path $sshKeyPath)) {
    Write-Step "3. Generating new SSH key..."
    $email = Read-Host "Enter your email address"
    
    # Create .ssh directory if it doesn't exist
    $sshDir = "$env:USERPROFILE\.ssh"
    if (-not (Test-Path $sshDir)) {
        New-Item -ItemType Directory -Path $sshDir -Force | Out-Null
    }
    
    # Generate SSH key using ssh-keygen
    try {
        ssh-keygen -t rsa -b 4096 -C $email -f $sshKeyPath -N '""'
        Write-Status "SSH key generated successfully"
    } catch {
        Write-Error "Failed to generate SSH key"
        exit 1
    }
}

# Step 4: Display SSH keys
Write-Step "4. SSH Key Information:"
Write-Host ""
Write-Status "Public Key (add this to RumahWeb):"
Write-Host "==========================================" -ForegroundColor Gray
Get-Content "$sshKeyPath.pub"
Write-Host ""
Write-Status "Private Key (add this to GitHub Secrets as SSH_PRIVATE_KEY):"
Write-Host "====================================================================" -ForegroundColor Gray
Get-Content $sshKeyPath
Write-Host ""

# Step 5: Check Git repository status
Write-Step "5. Checking Git repository status..."
if (-not (Test-Path ".git")) {
    Write-Warning "Not a Git repository. Initializing..."
    git init
    git add .
    git commit -m "Initial commit"
}

# Step 6: Check remote repository
Write-Step "6. Checking remote repository..."
try {
    $remoteUrl = git remote get-url origin
    Write-Status "Remote repository configured: $remoteUrl"
} catch {
    Write-Warning "No remote repository configured"
    $repoUrl = Read-Host "Enter your GitHub repository URL (e.g., https://github.com/username/repo.git)"
    git remote add origin $repoUrl
    Write-Status "Remote repository added"
}

# Step 7: Create GitHub Secrets template
Write-Step "7. Creating GitHub Secrets template..."
$secretsTemplate = @"
# 🔐 GitHub Secrets Template
# Add these secrets in your GitHub repository:
# Settings → Secrets and variables → Actions → New repository secret

# For Simple Workflow (.github/workflows/deploy-simple.yml):
SSH_PRIVATE_KEY = [Copy the private key from above]
REMOTE_HOST = [your-domain.com or server IP]
REMOTE_USER = [your-rumahweb-username]
REMOTE_TARGET = [/home/username/public_html]

# For Full Workflow (.github/workflows/deploy-rumahweb.yml):
FTP_SERVER = [ftp.your-domain.com]
FTP_USERNAME = [your-ftp-username]
FTP_PASSWORD = [your-ftp-password]
SSH_HOST = [your-domain.com or server IP]
SSH_USERNAME = [your-rumahweb-username]
SSH_PRIVATE_KEY = [Copy the private key from above]

# 📝 Instructions:
# 1. Go to your GitHub repository
# 2. Click Settings → Secrets and variables → Actions
# 3. Click "New repository secret"
# 4. Add each secret above with the correct values
# 5. Replace [brackets] with your actual values
"@

$secretsTemplate | Out-File -FilePath "github-secrets-template.txt" -Encoding UTF8
Write-Status "GitHub secrets template created: github-secrets-template.txt"

# Step 8: Test SSH connection (optional)
Write-Step "8. Testing SSH connection (optional)..."
$testSSH = Read-Host "Do you want to test SSH connection? (y/N)"
if ($testSSH -eq "y" -or $testSSH -eq "Y") {
    $remoteHost = Read-Host "Enter your RumahWeb domain or IP"
    $remoteUser = Read-Host "Enter your RumahWeb username"
    
    Write-Status "Testing SSH connection to $remoteUser@$remoteHost..."
    try {
        ssh -i $sshKeyPath -o ConnectTimeout=10 -o BatchMode=yes "$remoteUser@$remoteHost" "echo 'SSH connection successful!'"
        Write-Status "SSH connection test successful!"
    } catch {
        Write-Warning "SSH connection test failed. Make sure:"
        Write-Warning "1. Public key is added to RumahWeb SSH Access"
        Write-Warning "2. SSH Access is enabled in cPanel"
        Write-Warning "3. Domain/IP and username are correct"
    }
}

# Step 9: Final instructions
Write-Step "9. Final Setup Instructions:"
Write-Host ""
Write-Status "✅ SSH Key generated successfully!"
Write-Status "📁 Public key location: $sshKeyPath.pub"
Write-Status "📁 Private key location: $sshKeyPath"
Write-Host ""
Write-Status "📋 Next Steps:"
Write-Host "1. Add public key to RumahWeb SSH Access in cPanel" -ForegroundColor Cyan
Write-Host "2. Add GitHub secrets using the template in github-secrets-template.txt" -ForegroundColor Cyan
Write-Host "3. Push your code to GitHub:" -ForegroundColor Cyan
Write-Host "   git add ." -ForegroundColor White
Write-Host "   git commit -m 'Setup GitHub Actions deployment'" -ForegroundColor White
Write-Host "   git push origin main" -ForegroundColor White
Write-Host "4. Monitor deployment in GitHub Actions tab" -ForegroundColor Cyan
Write-Host ""
Write-Status "📚 Documentation:"
Write-Host "- Full guide: PANDUAN_GITHUB_RUMAHWEB.md" -ForegroundColor Cyan
Write-Host "- Troubleshooting: Check the troubleshooting section in the guide" -ForegroundColor Cyan
Write-Host ""
Write-Status "🎉 Setup completed! Your repository is ready for automated deployment."
