#!/usr/bin/env bash
# Builds dist/oc-portraits.zip for Appearance → Themes → Add New → Upload Theme.
set -euo pipefail
cd "$(dirname "$0")/.."
mkdir -p dist
rm -f dist/oc-portraits.zip
zip -rq dist/oc-portraits.zip oc-portraits -x '*.DS_Store'
echo "Built dist/oc-portraits.zip ($(du -h dist/oc-portraits.zip | cut -f1))"
