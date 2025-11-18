# Security Notice

## Exposed API Key - November 18, 2025

### Issue
A Google Maps API key was found hardcoded in the codebase and exposed in the Git repository:
- **File**: `app/View/Themed/Kapow/Layouts/default.ctp`
- **Key**: `AIzaSyAf5DtChzuCwa8uGr4gehSrhklvVHjzKhk`

### Status
**RESOLVED** - The hardcoded key has been removed and replaced with environment variable configuration.

### Action Required
**CRITICAL**: The exposed API key must be revoked and replaced:

1. **Revoke the exposed key immediately:**
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Navigate to APIs & Services → Credentials
   - Find the key `AIzaSyAf5DtChzuCwa8uGr4gehSrhklvVHjzKhk`
   - Delete or revoke it

2. **Generate a new API key:**
   - Create a new Google Maps API key
   - Restrict it to your domains only
   - Add the new key to your `.env` file:
     ```
     GOOGLE_MAPS_API_KEY=your_new_api_key_here
     ```

3. **Verify the fix:**
   - The application now reads the API key from environment variables
   - No API keys are hardcoded in the codebase
   - The `.env` file is in `.gitignore` and won't be committed

### Changes Made
- Removed hardcoded API key from view template
- Added environment variable support for Google Maps API key
- Updated `.env.example` with placeholder
- Configured CakePHP to load API key from environment
- Added this security notice

### Best Practices Going Forward
1. **Never commit secrets** to version control
2. **Use environment variables** for all API keys, passwords, and secrets
3. **Rotate exposed credentials** immediately upon detection
4. **Restrict API keys** to specific domains/IPs when possible
5. **Monitor for exposed secrets** using tools like GitGuardian

## Reporting Security Issues

If you discover a security vulnerability, please email security@kapow.us (or the appropriate contact) instead of opening a public issue.
