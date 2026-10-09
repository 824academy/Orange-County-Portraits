# Orange County Portraits — WordPress site

Family, children's, motherhood and maternity photography by **Zharmaine Boatman**, based in Cypress and serving Orange County. Target launch: **October 21, 2026**.

The site is a small custom **block theme** (`oc-portraits/`) built only from native WordPress blocks and patterns. It uses one plugin, **Contact Form 7**, for the inquiry form. Page text, photos, menus and blog posts are all edited in WordPress. There are no page builders, custom post types, gallery plugins or separate apps.

| | |
|---|---|
| Install file | `dist/oc-portraits.zip` (Appearance → Themes → Upload) |
| Setup and editing guide | [docs/SETUP-AND-EDITING.md](docs/SETUP-AND-EDITING.md) |
| Image placement checklist | [docs/IMAGE-CHECKLIST.md](docs/IMAGE-CHECKLIST.md) |
| Launch checklist and missing inputs | [docs/LAUNCH-CHECKLIST.md](docs/LAUNCH-CHECKLIST.md) |
| Verification report | [docs/VERIFICATION.md](docs/VERIFICATION.md) |
| Screenshots (desktop and phone) | [docs/screenshots/](docs/screenshots/) |

## What's built

- **Design:**
  - Sage `#9EAF9B` as the signature color.
  - Forest `#263E34` for text and buttons, pale sage `#EFF3ED` and white for backgrounds.
  - Dusty rose `#C6A49D` only for short rules and dots.
  - Newsreader serif headings and Figtree sans body text, self-hosted.
  - A text wordmark: ORANGE COUNTY / PORTRAITS.
  - Layout follows the supplied mockups (sage title bands, split photo heroes, numbered steps, collection cards, forest inquiry band, pale-sage footer), without their sample wording, sprig logos or photos.
- **Header:** Families · Children · Motherhood · Experience & Pricing · Blog · Contact. The wordmark links to Home.
- **Footer:** About · For Photographers · Corporate Photography · Music & Culture · Privacy.
- **Pages** (created by **Appearance → Site Setup** from theme patterns):
  - Home
  - Families
  - Children
  - Motherhood & Maternity
  - Experience & Pricing (pricing marked provisional)
  - Blog ("The Portrait Journal")
  - About
  - For Photographers & Organizations
  - Contact
  - A Privacy outline
- **Blog:**
  - A blog index (featured image, title, excerpt, pagination).
  - An article template (author, date, featured image, service links, related posts, inquiry button).
  - Homepage "recent posts" section that hides itself when there are no posts.
  - Five draft outlines, never auto-published.
- **Inquiry form:** one form with name, email, inquiry type, preferred dates, location or setting, and message. Validation, a success message, Reply-To set to the visitor, and the inquiry type preselected from each page's button.
- **Images:** 28 clearly labelled placeholders (IDs H1, F2…), matching the checklist.

## Status

**Done and tested locally** (WordPress 7.1.3):
- Theme, templates and patterns.
- Setup screen.
- Responsive layouts.
- Navigation and keyboard access.
- Blog behavior.
- Form validation and submission.

**Blocked on inputs** (details in the launch checklist):
- The hosting/site to install on.
- A real delivery test to zharmaine@824brandproductions.com.
- The 824 Brand Productions URL.
- Your photographs.
- Final pricing and the Complete Family image count.
- A short About paragraph in your words.
- Privacy details.
- Spam-protection keys.

## Development

```
php tools/build-placeholders.php   # regenerate placeholders + docs/IMAGE-CHECKLIST.md
tools/build-zip.sh                 # rebuild dist/oc-portraits.zip
```
