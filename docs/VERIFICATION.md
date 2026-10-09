# Verification report (local build, October 9, 2026)

**Test setup:**
- WordPress **7.1.3** (latest release) on SQLite.
- PHP 8.3.
- The `oc-portraits` theme, set up through **Appearance → Site Setup**.
- Contact Form 7, from its development branch (**6.2-rc**), because wordpress.org downloads were blocked from the build machine. **Use the stable Contact Form 7 from Plugins → Add New on the real site.**
- Pages checked in headless Chromium at **1366 px** (laptop) and **390 px** (phone).

Screenshots of every page at both widths are in `docs/screenshots/`. The blog screenshots use temporary "SAMPLE LAYOUT POST" entries that exist only on the test machine.

## Passed

| Area | Check | Result |
|---|---|---|
| Block markup | 426 blocks in the 10 pages, plus every template, template part, pattern and draft post, parsed by the block editor's validator | 0 invalid blocks (the validator was checked against a deliberately broken block) |
| Responsive | Horizontal overflow on all pages at 1366 and 390 px | None (page width = viewport) |
| Navigation | Header links, active-page underline with `aria-current="page"`; Blog stays active on posts | ✓ |
| Mobile menu | Opens from the menu button, moves focus into the menu, closes with Escape | ✓ |
| Keyboard | Skip link → wordmark → each menu link → page buttons, with a visible 2px forest focus outline | ✓ |
| Headings | Exactly one H1 per page; sections use H2/H3 | ✓ |
| Titles / descriptions | Each page has a descriptive `<title>` and a meta description taken from its excerpt | ✓ |
| Sitemap | `/wp-sitemap.xml` returns 200 and lists all 10 pages | ✓ |
| Blog index | Featured image, category, title, excerpt, "Read the article" link, pagination; message shown when there are no posts | ✓ |
| Homepage posts | Shows the 3 newest posts; the whole section disappears when no posts are published | ✓ |
| Article template | Category, title, author name, date, featured image, readable column, services box with links to all service pages, Plan-your-session button | ✓ |
| Related posts | Same category only, never the current post, hidden when there are none | ✓ (a bug in the first version was found and fixed) |
| Images | First content image gets `fetchpriority="high"`; later images get `loading="lazy"`, plus width/height and `srcset` for uploaded photos | ✓ |
| Form fields | Name, Email, Inquiry type, Preferred dates, Location or setting, Message, all with visible labels | ✓ |
| Form preselection | `/contact/?inquiry-type=Associate%20Photography` and the Host-a-Workshop link preselect the right type | ✓ |
| Form validation | Empty submit → message plus 3 highlighted fields with `aria-invalid` | ✓ |
| Form submission | "Thank you — your inquiry has been sent." The captured email has the subject "Orange County Portraits inquiry: Host a Workshop from Test Person", every field in the body, and a Reply-To set to the visitor | ✓ |

**Contrast** (WCAG):

| Combination | Ratio | Notes |
|---|---|---|
| Forest on white | 11.5:1 | |
| Forest on pale sage | 10.3:1 | |
| Forest on sage | 4.97:1 | |
| White on forest | 11.5:1 | |
| Moss (small text) on pale sage | 6.0:1 | |
| White on sage | 2.3:1 | Fails, so never used |
| Rose on white | 2.3:1 | Used only for decorative rules and dots, never for text |

## Needs checking on the real site

1. **Inquiry delivery to the real inbox.** Locally, mail was captured rather than sent. The recipient address still has to be set, and delivery confirmed (see LAUNCH-CHECKLIST.md §C).
2. **Resubmitting after a validation error.** With the 6.2-rc build, a second Send clicked immediately after typing in the last field was ignored until that field lost focus (the second click then worked). Retest with the stable plugin.
3. **Spam protection** (Akismet or Turnstile) needs keys, so it couldn't be exercised locally.
4. **Real photographs:** mobile crops, alt text, and file sizes.
5. **Search engine visibility** setting and the final domain in the sitemap.
