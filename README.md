# Psychwire — Dr Alex Rivera block theme

A custom WordPress block theme for a one-page site for Dr Alex Rivera, a fictional clinical psychologist and trainer in Sydney. Built for the Psychwire Lead Web Developer technical assessment.

- Block theme (`theme.json`, HTML templates and parts, PHP block patterns). No plugins, no admin screens added.
- All content is rendered on the server. The page ships **no JavaScript** (the only `<script>` is the JSON-LD data block).
- Semantic landmarks, one H1, then H2 sections and H3 course titles in order.
- Title, meta description and JSON-LD (`Person` plus three `Course` entries) are printed server-side.

## Structure

```
style.css          theme header + small global CSS (focus ring, courses grid)
theme.json         palette, typography, spacing, layout widths
functions.php      theme supports, enqueues style.css, loads inc/*
inc/data.php       psychwire_profile(), psychwire_courses()  <- single source of truth
inc/seo.php        <title>, meta description, JSON-LD @graph
inc/cleanup.php    removes core emoji and speculation-rules scripts (zero JS)
templates/         front-page.html (the one page), index.html (fallback)
parts/             header.html, footer.html
patterns/          hero, about, courses, contact (one <section> each)
assets/images/     dr-rivera.jpg
```

The courses and the profile live in `inc/data.php` only. The courses pattern loops over the same array that builds the JSON-LD, so the visible content and the structured data cannot drift apart. To change a course, edit it there.

## Run it locally

1. Copy or symlink this folder to `wp-content/themes/psychwire`.
2. Activate **Psychwire** under Appearance > Themes.
3. The page is the front page whatever the Reading setting is (`front-page.html`).

While developing, WordPress caches the list of pattern files. If you add a pattern file and it does not appear, clear transients (`wp transient delete --all`).

## What I checked

Run against the live Local site (`http://psychwire.local/`):

- **Lighthouse (mobile):** Performance 100, Accessibility 100, SEO 100, Best Practices 78. The Best Practices loss is only `is-on-https` / `redirects-http`, because the local site is plain `http://`; it is not a theme issue.
- **Layout at 375px:** no horizontal scroll (`scrollWidth` 375, no element wider than the viewport).
- **Keyboard:** tab order is skip link, brand link, About, Courses, Contact, email link; focus is visible.
- **Headings:** `h1, h2, h2, h3, h3, h3, h2` (no skipped levels).
- **JSON-LD:** parsed as valid JSON; graph contains one `Person` and three `Course` nodes, each with an online `CourseInstance` and an ISO 8601 `courseWorkload`. Not yet pasted into validator.schema.org (manual step).
- **No JavaScript:** `curl` of the page shows one `<script>` tag, the JSON-LD block. I removed WordPress core's emoji and speculation-rules scripts to get there.
- **Meta description:** 143 characters.

### Things I fixed along the way

- Block themes do not load `style.css` on the front end by themselves; the theme now enqueues it (this was why the first render had no card styling or focus ring).
- Removed my own skip link because WordPress core already adds one, which gave two identical tab stops.
- Kept the `mailto:` link as plain HTML so crawlers can read it.
- Shortened the first meta description, which was 164 characters.

The axe CLI could not run here (ChromeDriver and Chrome versions differ), so accessibility was checked with Lighthouse, which runs the axe-core rules.

## Credits

Photo: portrait by Joecalih on [Unsplash](https://unsplash.com/photos/a-young-professional-woman-smiling-against-a-white-background-1l6UeCc9P9o), used under the Unsplash License. Cropped and resized.
