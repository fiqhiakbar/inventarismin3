#!/bin/bash

# 🚀 Script Setup GitHub-RumahWeb Integration
# Author: AI Assistant
# Version: 1.0

echo "🔄 Setting up GitHub-RumahWeb Integration..."
echo "=============================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_step() {
    echo -e "${BLUE}[STEP]${NC} $1"
}

# Check if running on Windows
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
    print_error "This script is designed for Unix-like systems (Linux/Mac)"
    print_error "For Windows, please use Git Bash or WSL"
    exit 1
fi

# Step 1: Check if Git is installed
print_step "1. Checking Git installation..."
if ! command -v git &> /dev/null; then
    print_error "Git is not installed. Please install Git first."
    exit 1
else
    print_status "Git is installed: $(git --version)"
fi

# Step 2: Check if SSH key already exists
print_step "2. Checking existing SSH keys..."
SSH_KEY_PATH="$HOME/.ssh/rumahweb_key"

if [ -f "$SSH_KEY_PATH" ]; then
    print_warning "SSH key already exists at $SSH_KEY_PATH"
    read -p "Do you want to overwrite it? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        print_status "Using existing SSH key"
    else
        rm -f "$SSH_KEY_PATH" "$SSH_KEY_PATH.pub"
    fi
fi

# Step 3: Generate SSH key if needed
if [ ! -f "$SSH_KEY_PATH" ]; then
    print_step "3. Generating new SSH key..."
    read -p "Enter your email address: " EMAIL
    
    ssh-keygen -t rsa -b 4096 -C "$EMAIL" -f "$SSH_KEY_PATH" -N ""
    
    if [ $? -eq 0 ]; then
        print_status "SSH key generated successfully"
    else
        print_error "Failed to generate SSH key"
        exit 1
    fi
fi

# Step 4: Display SSH keys
print_step "4. SSH Key Information:"
echo
print_status "Public Key (add this to RumahWeb):"
echo "=========================================="
cat "$SSH_KEY_PATH.pub"
echo
print_status "Private Key (add this to GitHub Secrets as SSH_PRIVATE_KEY):"
echo "===================================================================="
cat "$SSH_KEY_PATH"
echo

# Step 5: Check Git repository status
print_step "5. Checking Git repository status..."
if [ ! -d ".git" ]; then
    print_warning "Not a Git repository. Initializing..."
    git init
    git add .
    git commit -m "Initial commit"
fi

# Step 6: Check remote repository
print_step "6. Checking remote repository..."
if ! git remote get-url origin &> /dev/null; then
    print_warning "No remote repository configured"
    read -p "Enter your GitHub repository URL (e.g., https://github.com/username/repo.git): " REPO_URL
    git remote add origin "$REPO_URL"
    print_status "Remote repository added"
fi

# Step 7: Create GitHub Secrets template
print_step "7. Creating GitHub Secrets template..."
cat > github-secrets-template.txt << EOF
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
EOF

print_status "GitHub secrets template created: github-secrets-template.txt"

# Step 8: Test SSH connection (optional)
print_step "8. Testing SSH connection (optional)..."
read -p "Do you want to test SSH connection? (y/N): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    read -p "Enter your RumahWeb domain or IP: " REMOTE_HOST
    read -p "Enter your RumahWeb username: " REMOTE_USER
    
    print_status "Testing SSH connection to $REMOTE_USER@$REMOTE_HOST..."
    ssh -i "$SSH_KEY_PATH" -o ConnectTimeout=10 -o BatchMode=yes "$REMOTE_USER@$REMOTE_HOST" "echo 'SSH connection successful!'"
    
    if [ $? -eq 0 ]; then
        print_status "SSH connection test successful!"
    else
        print_warning "SSH connection test failed. Make sure:"
        print_warning "1. Public key is added to RumahWeb SSH Access"
        print_warning "2. SSH Access is enabled in cPanel"
        print_warning "3. Domain/IP and username are correct"
    fi
fi

# Step 9: Final instructions
print_step "9. Final Setup Instructions:"
echo
print_status "✅ SSH Key generated successfully!"
print_status "📁 Public key location: $SSH_KEY_PATH.pub"
print_status "📁 Private key location: $SSH_KEY_PATH"
echo
print_status "📋 Next Steps:"
echo "1. Add public key to RumahWeb SSH Access in cPanel"
echo "2. Add GitHub secrets using the template in github-secrets-template.txt"
echo "3. Push your code to GitHub:"
echo "   git add ."
echo "   git commit -m 'Setup GitHub Actions deployment'"
echo "   git push origin main"
echo "4. Monitor deployment in GitHub Actions tab"
echo
print_status "📚 Documentation:"
echo "- Full guide: PANDUAN_GITHUB_RUMAHWEB.md"
echo "- Troubleshooting: Check the troubleshooting section in the guide"
echo
print_status "🎉 Setup completed! Your repository is ready for automated deployment."
