# Design System Strategy: High-End Culinary Heritage

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Heritage Epicurean."** 

This system is designed to transform the 'Mắm Tép Hạ Long' digital presence from a standard e-commerce shop into a curated editorial experience. It moves away from the rigid, boxed-in layouts of traditional web design in favor of an asymmetrical, layered aesthetic that reflects the craftsmanship of Vietnamese coastal cuisine. 

By leveraging intentional whitespace, high-contrast serif typography, and a "physical" approach to depth, we create a space that feels as premium and authentic as the artisanal products themselves. The design system rejects the "template" look, instead using overlapping imagery and tonal shifts to guide the user's journey through the flavors of Ha Long.

## 2. Colors: The Palette of the Coast
The color story is rooted in the rich, fermented hues of Mắm Tép and the golden sun of the bay.

- **Primary (`#6b0d0d`)**: Use this rich terracotta sparingly for high-impact brand moments—main CTAs, primary headlines, or signature icons.
- **Secondary (`#795900`)**: This golden accent provides warmth. Use it for interactive elements like hover states or specialized labels to signify premium quality.
- **Surface & Background (`#fdf9f4`)**: The "Cream" base. It provides a soft, breathable canvas that feels more organic and "paper-like" than pure white.

### The "No-Line" Rule
To maintain a high-end editorial feel, **1px solid borders are strictly prohibited for sectioning.** Boundaries must be defined solely through background color shifts. For example, a product gallery section using `surface-container-low` (`#f7f3ee`) should sit directly against a `surface` (`#fdf9f4`) background.

### Surface Hierarchy & Nesting
Treat the UI as a series of stacked, fine papers. 
- Place a `surface-container-lowest` card on a `surface-container-low` section to create a soft, natural lift. 
- Use the `surface-container` tiers (`lowest` to `highest`) to imply importance without adding visual clutter.

### The "Glass & Gradient" Rule
For floating elements (like a sticky header or a shopping cart summary), use **Glassmorphism**. Apply a semi-transparent `surface` color with a `backdrop-filter: blur(20px)`. 
- **Signature Texture:** Apply a subtle linear gradient from `primary` (`#6b0d0d`) to `primary-container` (`#8b2621`) on main action buttons to give them a three-dimensional, "hand-crafted" depth.

## 3. Typography: The Editorial Voice
Our typography pairing is a dialogue between tradition and modern clarity.

- **Display & Headlines (`notoSerif`)**: The "Heritage" voice. These should be set with generous tracking and used for evocative storytelling.
    - *Usage:* `display-lg` (3.5rem) for hero statements; `headline-md` (1.75rem) for product names like *Chả Mực* or *Mắm Tép Chưng Thịt*.
- **Body & Labels (`manrope`)**: The "Modern" voice. This clean sans-serif ensures high readability for ingredient lists and descriptions.
    - *Usage:* `body-lg` (1rem) for product descriptions; `label-md` (0.75rem) for price points and metadata.

**Hierarchy Tip:** Always pair a `headline-lg` serif with a `body-md` sans-serif subhead to create an authoritative, magazine-style layout.

## 4. Elevation & Depth: Tonal Layering
Depth in this design system is felt, not seen. We avoid heavy, artificial shadows in favor of natural light physics.

- **The Layering Principle:** Avoid shadows for static content. Instead, "stack" surface tiers. A card containing the *Chả Cá* product should be `surface-container-lowest` (#ffffff) sitting on a `surface-container-low` (#f7f3ee) background.
- **Ambient Shadows:** For interactive floating elements (e.g., a "Quick Buy" drawer), use an extra-diffused shadow: `box-shadow: 0 10px 40px rgba(28, 28, 25, 0.06)`. Note the use of a tinted `on-surface` color for the shadow rather than pure black.
- **The "Ghost Border" Fallback:** If a divider is required for accessibility, use the `outline-variant` (`#dec0bc`) at **15% opacity**. This creates a "suggestion" of a line that doesn't break the editorial flow.

## 5. Components: Grounded in Heritage

### Buttons
- **Primary:** Gradient fill (`primary` to `primary-container`), white text, `lg` (0.5rem) roundedness.
- **Secondary:** `outline-variant` ghost border at 20% opacity, `primary` text.
- **Interactive State:** On hover, primary buttons should subtly scale (1.02x) rather than just changing color.

### Cards (Product & Story)
- **Rule:** No borders, no shadows. 
- Use high-quality photography as the anchor. The image should slightly "bleed" over the edge of its container (intentional asymmetry) to break the grid.
- Use `surface-container-lowest` for the card background.

### Input Fields
- **Style:** Underline-only or very soft `surface-container-high` backgrounds. 
- Avoid heavy boxes. When active, use a `secondary` (Golden Yellow) bottom border to signal focus.

### Additional Component: "The Provenance Tag"
A specialized **Chip** for "Hạ Long Original" or "Traditional Recipe." Use a `secondary-container` (#ffc641) background with `on-secondary-container` (#715300) text to act as a seal of quality.

## 6. Do’s and Don’ts

### Do:
- **Use "Signature Whitespace":** Give product photography room to breathe. A single product image (e.g., *Mắm Tép*) should occupy at least 50% of the horizontal viewport in hero sections.
- **Embrace Asymmetry:** Place text blocks slightly off-center from the images they describe.
- **Use Color as Wayfinding:** Use the `primary` maroon to draw the eye to the "Add to Cart" or "Our Story" journey.

### Don’t:
- **No Divider Lines:** Do not use `<hr>` or solid borders between list items. Use vertical spacing (minimum 32px) or a subtle background shift.
- **No Generic Shadows:** Avoid the "card-with-black-shadow" look prevalent in basic bootstrap designs.
- **Don't Overcrowd:** This is a premium brand. Avoid cramming multiple products into a single tight row. Stick to 2 or 3 items max per row for a luxurious feel.
- **No Pure Black:** Ensure all text uses `on-surface` (#1c1c19) to maintain the warmth of the cream/terracotta palette.