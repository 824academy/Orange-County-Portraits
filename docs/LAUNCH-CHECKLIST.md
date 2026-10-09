# Launch checklist — target October 21, 2026

## A. Inputs still needed from Zharmaine

| # | Input | Blocks | Where it goes |
|---|---|---|---|
| 1 | **Hosting / which WordPress site** this goes on, with admin access | Installing the theme | See SETUP-AND-EDITING.md §1 |
| 2 | **Photographs** for the placements in IMAGE-CHECKLIST.md, including a real photo of you (H7/A1) | Launch visuals | Replace placeholders |
| 3 | **Final pricing approval**, and the **Complete Family image-count policy** | Removing "Provisional" labels | Experience & Pricing |
| 4 | **Two or three sentences about you** in your own words | About page | About → paragraph in [brackets] |
| 5 | **Privacy details:** gallery service name, analytics/cookies, how client images are handled | Privacy page | Privacy Policy (bracketed items) |
| 6 | **Spam-protection choice:** Akismet key or Cloudflare Turnstile keys | Form spam protection | Contact → Integration |
| 7 | **Domain** the site will use | Sitemap / Search Console | Settings → General |

## B. Before launch

- [ ] All placeholders replaced, or the block deleted. Search each page for "Photo placeholder".
- [ ] Alt text written for every photograph, describing the real image.
- [ ] No `[bracketed]` notes left on any page. Check About, Privacy, and Experience & Pricing.
- [ ] Provisional pricing label removed once pricing is approved, or kept on purpose.
- [ ] 824brandproductions.com is live (the footer "Corporate Photography" link and the About card point to it).
- [ ] Draft blog outlines are either written and published, or left as drafts. The homepage hides the blog section until a post is published.
- [ ] **Settings → Reading:** homepage = Home, posts page = The Portrait Journal.
- [ ] **Settings → Reading → Search engine visibility** is *unchecked* for the live site. Keep it checked on any staging copy.
- [ ] **Settings → Permalinks:** Post name.
- [ ] **Users → Profile:** display name "Zharmaine Boatman".
- [ ] **Sitemap:** open `https://YOURDOMAIN/wp-sitemap.xml`. It should list the nine pages plus Privacy. An SEO plugin replaces this with its own sitemap, and that's fine.
- [ ] Submit the sitemap in Google Search Console after launch.
- [ ] Browser tab icon: **Settings → General → Site Icon** (optional; a simple "OC" mark works).

## C. Inquiry delivery test (on the live site)

Inquiries go to zharmaine@824brandproductions.com. Do this after turning on spam protection.

- [ ] Open `/contact/` on a phone and send a **Family Session** inquiry, using a different email address from the recipient.
- [ ] Confirm the email arrives (check the spam folder), with:
  - Subject: "Orange County Portraits inquiry: Family Session from …"
  - **Reply-To** set to the sender, so pressing Reply answers the client.
- [ ] Repeat with **Discuss an Assignment** (For Photographers page). The form should open with *Associate Photography* already selected.
- [ ] Repeat with **Host a Workshop**. It should open with *Host a Workshop* selected.
- [ ] Submit the form empty and confirm the fields are highlighted with a message.
- [ ] Then fill the fields and submit again, and confirm it sends. This needs a recheck on the live site: in local testing with a pre-release Contact Form 7 build, an immediate re-click right after typing was sometimes ignored until the field lost focus. If it happens on the stable version, report it so it can be fixed.
- [ ] If emails don't arrive, install **WP Mail SMTP** and connect it to your email provider, then retest.

## D. Quick visual pass (phone + laptop)

- [ ] Header menu opens and closes on a phone. Every link works.
- [ ] Hero photos crop well on a phone (shown at 4:3) and on a laptop.
- [ ] Each "Plan Your Session" button goes to `/contact/`.
- [ ] Blog: after the first post is published, it shows on the homepage, on `/blog/`, and in "Related posts" once there are two posts in the same category.
