# Setup and editing guide

Orange County Portraits runs on one small custom block theme (`oc-portraits`) plus one plugin (Contact Form 7). All page text, images, menus and posts are edited inside WordPress. Nothing is hard-coded into templates except layout.

---

## 1. Install (about 15 minutes)

**Where:** a new WordPress site. On **WordPress.com**, the **Personal plan ($48/year, as listed October 2026) or higher** allows uploading themes and plugins, which is all this site needs. Business adds staging sites, SFTP and Akismet spam protection, but none of those are required. Self-hosted WordPress also works. None of your existing WordPress.com sites has been used or changed.

**Keep an existing site safe:** if this goes onto a site that's already live, install it on a staging copy first. You can also use **Appearance → Themes → Live Preview**, which shows the theme without activating it.

1. **Upload the theme.** Go to **Appearance → Themes → Add New Theme → Upload Theme**, choose `dist/oc-portraits.zip`, then **Activate**.
2. **Install the form plugin.** Go to **Plugins → Add New**, search for **Contact Form 7** (by Takayuki Miyoshi), then **Install** and **Activate**.
3. **Create the pages.** Go to **Appearance → Site Setup**.
   - Tick **Create missing pages** and choose **drafts** for a first review, or **published** for a brand-new site.
   - Tick **Create the inquiry form**.
   - Optionally tick **Add five draft blog outlines**.
   - Click **Run selected steps**. Existing pages and posts are never changed, so it's safe to run again.
4. **Set the homepage.** When the pages look right, publish **Home** and **The Portrait Journal**. Then run Site Setup again with **Use "Home" as the homepage…** ticked. That step also:
   - Sets the blog to `/blog/`.
   - Switches links to post-name permalinks.
   - Registers the Privacy page.
5. **Name the author.** Go to **Users → Profile → Display name publicly as** and choose **Zharmaine Boatman**. Blog posts show this name.
6. **Check where inquiries go.** The form sends to **zharmaine@824brandproductions.com**. To change it later, go to **Contact → Session inquiry → Mail tab → To**, then **Save**. Replies go straight to the visitor (Reply-To is set).
7. **Turn on spam protection** (pick one):
   - **Cloudflare Turnstile** (free; recommended on the WordPress.com Personal plan): create a free Cloudflare account, add a Turnstile widget for your domain, then paste the site key and secret into **Contact → Integration → Cloudflare Turnstile**. The check appears on the form automatically.
   - **Akismet:** included on WordPress.com Business, or available with an API key on self-hosted sites. The form already sends name and email to Akismet.
8. **Test the form.** Send one test inquiry for each inquiry type, from a phone and from a computer, and confirm each one arrives (see the launch checklist). If messages land in spam or never arrive, install **WP Mail SMTP** and send through your email provider.

### Page addresses created

| Page | Address | Template |
|---|---|---|
| Home | `/` (page slug `home`) | Landing page |
| Families | `/families/` | Landing page |
| Children | `/children/` | Landing page |
| Motherhood & Maternity | `/motherhood-maternity/` | Landing page |
| Experience & Pricing | `/experience-pricing/` | Landing page |
| Blog — "The Portrait Journal" | `/blog/` | Blog index (automatic) |
| About | `/about/` | Landing page |
| For Photographers & Organizations | `/for-photographers/` | Landing page |
| Contact | `/contact/` | Landing page |
| Privacy Policy | `/privacy/` | Standard page |

The header and footer menus link to these addresses. If you rename a page's address, also update the link in the menu (see section 3).

---

## 2. Editing pages

Open **Pages**, click a page, and edit it like a document. Every section is made of ordinary blocks (Group, Columns, Heading, Paragraph, Image, Buttons, Details).

- **Text:** click and type.
- **Buttons:** click the button to change its text. Use the link icon to change where it goes. In the block sidebar under **Styles**, pick **Solid with arrow** or **Outline with arrow**.
- **Section backgrounds:** select the outer Group, then **Styles → Color → Background**. The palette has only the five brand colors, plus a "Moss" green used for small text.
- **Reusable sections:** to add another section, click **+** → **Patterns** → **OC Portraits: sections**. The options are a title band, split hero, photo beside text, three-photo row, service cards, steps, recent posts, and an inquiry band.
- **Starting a new page:** WordPress offers the **OC Portraits: full pages** patterns.
- **Meta description (search snippet):** in the page sidebar, open **Excerpt** and edit it to 1–2 sentences. Each page already has a draft. If you later install an SEO plugin (Yoast, Rank Math, etc.), the theme stops printing its own description automatically, and you edit it in the plugin instead.

### Replacing placeholder photos

Each placeholder shows an ID such as **H1** or **F2**. `docs/IMAGE-CHECKLIST.md` lists the size and orientation for each one.

1. Click the placeholder, then choose **Replace → Upload** (or pick from the Media Library).
2. In the sidebar, write **Alternative text** that describes your actual photo. Example: "Mother holding her toddler on a blanket in the grass."
3. The crop shape is kept automatically. To fine-tune it, use **Aspect ratio** in the image sidebar.

WordPress creates the smaller image sizes automatically. The first image on each page (the hero) loads with priority, and everything below it loads as visitors scroll.

### Pricing

Pricing lives in one place, on **Experience & Pricing**. The other service pages only link to it. The "Provisional pricing — draft for review" label and note are normal paragraphs. Delete them once pricing is approved. The Complete Family card shows **[Final image count to be confirmed]**; replace that line when you've decided.

---

## 3. Header, footer and menus

Go to **Appearance → Editor → Patterns → Template parts**, then choose **Header** or **Footer**.

- **Menu links:** click the navigation, then click a link to change its label or address. Use **+** to add a link.
- **Footer "Corporate Photography":** links to https://824brandproductions.com/.
- **Wordmark:** the site title (**Settings → General → Site Title**) is shown as ORANGE COUNTY / PORTRAITS. The theme automatically sets the last word as the small second line.
- **Closing inquiry band** on the blog and articles: **Template parts → Inquiry band**.

Changes made in the Site Editor are saved in the database. To return to the theme's original version, open the template's **⋮** menu and choose **Reset**.

---

## 4. Publishing a blog post

1. Go to **Posts → Add New** (or open one of the draft outlines).
2. **Title:** say plainly what the post is about. For example, "What to Wear for Family Portraits".
3. **Featured image** (sidebar): a landscape photo, about 2000 × 1250 px, with the subject centred. It appears cropped 16:9 at the top of the post, 16:10 on the blog page, 3:2 on the homepage and 4:3 under "Related posts".
4. **Category:** choose one, such as *Session Planning*, *Locations* or *Prints*. Related posts are matched by category.
5. **Write** with Heading 2 for sections and Heading 3 for sub-points. Keep paragraphs short.
6. **Link to service pages in the text** where it helps the reader, for example "…see how [family sessions](/families/) work". Each article also ends with an automatic box linking to Families, Children, Motherhood & Maternity and Experience & Pricing, plus a "Plan your session" button.
7. **Excerpt** (sidebar): one or two sentences. It's used on the blog page, on the homepage and as the search description.
8. **Publish.** The homepage's "From the Portrait Journal" section updates on its own (it shows the three newest posts) and stays hidden until the first post is published.

### Suggested first articles (draft outlines are included)

- What to Wear for Family Portraits
- Preparing Children for a Portrait Session
- Studio or Outdoors: Choosing Your Portrait Setting
- Choosing a Location for Outdoor Portraits in Orange County. **Check permit, fee and access rules directly with each location before you write about them.**
- Printing Your Digital Portraits

Write them in your own words, using your own photographs. The outlines are drafts and are never published automatically.

---

## 5. What's in the theme folder

```
oc-portraits/
  style.css, theme.json     colors, fonts, spacing, button and form styling
  functions.php             small filters (wordmark, active menu link, related posts,
                            hide empty post sections, meta description, image loading)
  inc/setup.php             Appearance → Site Setup (admin only)
  inc/blocks.php            helpers that print block markup for the patterns
  inc/image-slots.php       image placements (also generates placeholders + checklist)
  templates/                page, landing page, blog, single post, archive, search, 404
  parts/                    header, footer, inquiry band
  patterns/                 9 page patterns, 8 section patterns, 1 blog-post starter
  assets/fonts/             Newsreader + Figtree (self-hosted, Open Font License)
  assets/placeholders/      labelled placeholder images
```

To regenerate the placeholders and image checklist after editing `inc/image-slots.php`, run `php tools/build-placeholders.php`. To rebuild the zip, run `tools/build-zip.sh`.
