# Changelog
All notable changes to this project will be documented in this file and formatted via [this recommendation](https://keepachangelog.com/).

## [1.9.6.1] - 2025-06-17
### Added
- Smart Tags support in the Default Value setting for Name field subfields.

### Fixed
- WPForms updates did not work consistently with the WP Umbrella plugin.
- The layout of the Order Summary table was broken on Windows operating systems.
- The layout of the Stripe custom fields mapping table was broken in the form builder.

## [1.9.6] - 2025-06-03
### Added
- Form Themes for Elementor.
- Customer phone, Payment, and Customer metadata can now be configured on the Form Builder > Payments > Stripe screen.

### Changed
- Improved styles on Tools > Scheduled Actions page with reset search filter.
- Improved Form Builder loading.
- Updated intl-tel-input library to 25.3.1.
- Required select fields have default placeholder text to prevent the submission of default values.
- Improved message about missing PHP extensions.
- Updated DOMPurify library to 3.2.6.

### Fixed
- Captcha verification was skipped for payment forms.
- The Entry Date wasn't submitted in the {entry_date} smart tag when you sent it to a Google Sheets spreadsheet.
- Email notification was malformed when a form had a Total field with the "Order Summary" enabled.
- The marketing provider's name was not specified in the warning popup when a field with conditional logic was removed.
- An error occurred when installing a plugin through the Gutenberg block.
- Addon fields were not rendered on the front-end on multisite if addons were not activated site-wide.
- Missing popup about unsaved changes when closing the form from the Marketing tab.
- Compatibility with Elementor editor.
- The "Plugin is in the Latest Version" error occurred when updating several addons using bulk update on the Plugins page.
- There was no popup about unsaved changes displayed after typing into the MCE editor.
- Layout issues of the Square credit card field.
- JavaScript error occurred when a form was added in the Elementor popup.
- Fields were added to the form in the wrong order under some conditions.

## [1.9.5.2] - 2025-05-05
### Fixed
- Issue sending form notifications using email fields that had ID=0.

## [1.9.5.1] - 2025-04-29
### Fixed
- Multi-step form with required address field was not possible to proceed for countries with no state.
- Incorrect alignment of Layout fields in email notification templates.
- AJAX request for Stripe payments was sent twice, which might lead to missed entries and payment records.
- `{field_id="#"}` smart tag didn't work for CC field in email notifications.

## [1.9.5] - 2025-04-22
### IMPORTANT
- Support for PHP 7.1 has been discontinued. If you are running PHP 7.1, you MUST upgrade PHP before installing WPForms 1.9.5. Failure to do that will disable WPForms core functionality.

### Added
- Users can connect their Square accounts and receive payments via their payment forms.
- New design for Smart Tags.
- The ability to activate and deactivate email notifications through a status button in the form builder.

### Changed
- Enhancing the prevention of duplicate form submissions.
- Improved the error messaging when creating new provider connections in the form builder.
- Improved the "From Email" setting validation in the Notifications screen.
- Improved compatibility with OptinMonster popups.
- The prompt input field now resizes when a user provides long text.
- AI Chat Modal can be docked to the right of the builder.
- Changed the order of the admin bar menu items.
- Improved compatibility with PHP 8.1.
- Update-related details for WPForms plugins and addons had views inconsistent with those of other WordPress plugins.
- Improved UX for Dropdown and Dropdown Items fields.

### Fixed
- Hidden by conditional logic items in the Order Summary table were shown in the Editors.
- The state subfield in the address field is now hidden if a user is filling in the address in a country that does not have states.
- Form Themes templates were disabled when the form is reselected on the page.
- The description of the Payment Single Item field was not reflected in the form builder.
- Stripe settings were active when the credit card field was removed from the form.
- The form created with the AI Form Generator had the "Store spam entries in the database" setting disabled.
- Form Builder saving was failing with an Uncaught SecurityError in the console when the preview tab was redirected to a PPS/PPC page.
- The notice for the minimum and maximum valid values of the Number Slider field is now correct.
- WPForms Challenge RTL issues.
- The Repeater and Layout fields grids became broken on the single entry page when some columns were empty.
- Incorrect wpforms_htaccess_file transient name generation.
- Console error when users tried to embed a form into an existing page on the last step of the WPForms Challenge.
- The submit button stays disabled after Stripe payment fails in some cases.
- The Dropdown and Dropdown Items fields displayed placeholders instead of default values in the Form Builder.
- The DateTime field smart tags' values had an incorrect format.
- Content and HTML fields inside the Repeater field did not appear when enabling the HTML/Content toggle.
- Hidden Layout and Repeater labels were visible on the Single Payment page.
- Wrong paddings in the Form Builder sidebar on Windows in the RTL mode.
- AI-generated addon fields were available on the Single Entry page when addons were not activated.
- Required number fields hidden by Conditional Logic couldn't be empty on the Edit Entry screen.
- Inactive addons fields generated by AI Forms were displayed on the Export and Form Entries pages.
- Improved the From Email notification setting. The Email field is detected now by a smart tag.
- Improved notification template for the {entry_geolocation} smart tag.

## [1.9.4.2] - 2025-03-12
### Fixed
- The Address field had the Country label in the Form Builder for the US scheme.
- Character encoding issues in Email notifications when viewed on some Apple devices.

## [1.9.4.1] - 2025-02-27
### Fixed
- Fatal error with a custom country address scheme.

## [1.9.4] - 2025-02-25
### Added
- Added preservation of deactivated addon settings when saving forms.
- Minimum and maximum value validation for the Numbers field was added.
- Implemented password protection and user access restrictions for uploaded files.
- Automatic preview page reload was added after saving.

### Changed
- Improved Gutenberg block UI by hiding settings when no form is selected.
- Updated stripe/stripe-php library to 16.5.0.
- Enhanced Tools > Scheduled Actions visibility for better compatibility with Action Scheduler, WooCommerce, and WP Rocket plugins.
- Restricted GDPR Agreement field usage in the Repeater field.
- Improved Stripe payments customer address handling.
- Optimized number slider calculations for better decimal precision.
- Improved Numbers and Number Slider fields settings interface in the form builder.

### Fixed
- Restored Smartphone field default values in Save and Resume and Entry Preview.
- Fixed database error when sorting by Entries Notes count.
- Resolved Phone field dropdown positioning issues in Layouts.
- Fixed Stripe Credit Card field payment element console warnings.
- Fixed empty smart tag values when entry saving is disabled.
- Resolved form submission debug log warnings.
- Fixed URL referer smart tag functionality for external websites.
- Addressed GDPR enhancements setting flashings on refresh.
- Resolved Modern Antispam false positives with Entry Preview and WPFML.
- Prevented payment form data loss with disabled addons.
- Resolved Stripe payments processing for Indian accounts.
- Corrected Payments Summary chart tooltip display.
- Improved decimal precision in number slider field calculations.
- Enhanced WPForms admin pages performance.
- Fixed backslash handling in form data after saving.
- Prevented duplicate entry submissions with reCAPTCHA v3.
- Restored missing Order Summary item names for hidden label fields.
- Resolved Entry Overview page sorting by notes count.
- Improved Order Summary performance with conditional Multiple Items fields.
- Fixed Dynamic Choice fields button behavior.
- Fixed display of zero-price Payment Checkbox items.
- Resolved Smart Phone field compatibility with OptinMonster popups.
- Fixed Stripe Credit Card field styling in Divi builder.

## [1.9.3.2] - 2025-01-28
### Fixed
- Modern Antispam flagged the entry as spam if the form includes the Entry Preview field and the WPForms Multilingual plugin was installed.
- GDPR enhancements sub-setting briefly flashed on the WPForms > Settings admin page after refresh.
- HTML attributes in links disappeared in the Content field after saving.

## [1.9.3.1] - 2025-01-16
### Changed
- The Hide Labels option is ignored in notifications.

## [1.9.3] - 2025-01-14
### IMPORTANT
- Support for PHP 7.0 has been discontinued. If you are running PHP 7.0, you MUST upgrade PHP before installing WPForms 1.9.3. Failure to do that will disable WPForms core functionality.

### Added
- Ability to open the Form Builder with a specific section via URL parameter.
- Compatibility status messages for addons on the Addons page.
- Support for Block API versions 2 and 3.
- Support for Page Break field in AI Forms.
- Support for the Constant Contact API v3.
- Quick page navigation on the Forms Overview page.
- Column view support for Layout and Repeater fields in admin pages.
- Direct access to Tools sections from WPForms top admin menu.

### Changed
- Updated stripe/stripe-php library to 16.3.0.
- Updated DOMPurify library to 3.2.3.
- Enhanced Date/Time field validation for Date Dropdown format.
- Optimized Order Summary table display on mobile devices.
- Improved date formatting consistency in payments table.
- Removed dynamic missing translation fix to improve performance.

### Fixed
- Layout field label visibility in email notifications with conditional logic.
- Missing addon name in warning popup for fields with conditional logic.
- Tooltip text overlap in Choices.js dropdowns with long tags.
- Default payment choice label visibility in order summary table.
- Total amount calculation was incorrect on the Entry preview page in some cases.
- Hidden single item field visibility in Order Summary and Entry preview.
- Content field positioning when printed in compact display.
- Entry print button width with non-English languages.
- Unnecessary CSS variables output on pages without forms.
- Toggle icon status glitch on the payments settings section.
- Layout field visibility in email notifications with empty values.
- Missing field numbers for duplicated Repeater fields in Single Entry view.
- When deleting a field with Conditional Logic, incorrect field names involved in the Conditional Logic were displayed.
- Addon download failures due to expired links.
- Form Builder Marketing panel splash screen display with revisions.
- Stripe Payment element display in Conversational Forms.
- RTL support for Layout and Repeater fields.
- Loading spinner was shown on the Form Builder > Marketing screen when there were no active connections.
- Submit button text handling with empty values.
- Non-Latin characters have been stripped from the URL when used in {page_url} and {url_referer} smart tags.
- Email field unique answer validation in multi-page forms.
- Field order in Order Summary with Rows Layout.
- Content and HTML field handling in single entry view.
- Repeater field order in CSV attachments.
- Block Editor field compatibility.
- Warning appeared in the debug.log when non-string data were erroneously sent to translation.
- Layout and Repeater field appearance in notifications.
- Custom validation message display for sub-fields.
- Number Slider default value behavior.
- Entries were duplicated in some environments.
- Stripe Credit Card field in Elementor popups.
- Integration data preservation when addons are disabled.
- Entry Preview layout with complex fields.
- Date field compatibility in WPForms Lite.
- Submit button default label handling.
- An error was happening when removing “Copy / Paste Style Settings” in Elementor and Block editor.
- The “Copy / Paste Style Settings” field default value was empty when adding an Elementor WPForms block.
- Error handler improvements.
- Fields inside the Layout field were displayed incorrectly based on the conditional logic.
- When user opened Help in Builder, the default help string was incorrect for Brevo and Kit addons.
- Some emails were not added to Constant Contact integration.
- The WPForms Challenge steps were shown in the AI Form Generator panel.
- PHP 7.1 and 7.2 compatibility.

## [1.9.2.3] - 2024-12-03
### Changed
- Creating a custom form theme is now available only to Administrators.

### Fixed
- Translated form action notices had an "s" letter appended to the form/template translated name.
- The Minimum time to submit setting consistently blocked form submissions on sites created in WordPress Studio.
- The '_load_textdomain_just_in_time was called incorrectly' error with child themes.
- In rare cases, a fatal error could happen on plugin activation.
- In some cases, selecting entries by date range may cause fatal error.
- Uncanny Automator could not be activated from the form builder.

## [1.9.2.2] - 2024-11-18
- Fixed _load_textdomain_just_in_time notice with WordPress 6.7.
- Some translations were empty with WordPress 6.5+.

## [1.9.2.1] - 2024-11-06
### Fixed
- A fatal error occurred on the plugins admin page with some third-party plugins.

## [1.9.2] - 2024-11-05
### Added
- Form generation with AI.
- The Settings section in the WPForms admin bar menu.
- Toggle allowing to turn specific notifications on or off.
- Update Stripe payments status after canceling a refund in the Stripe dashboard.
- Open the URL in the new tab for Confirmations.
- Repeater fields support for the Entry CSV Attachment settings.
- New `$row_id` parameter to the `wpforms_pre_update_{$type}` and `wpforms_post_update_{$type}` actions.
- AI chat warning messages if prohibited code has been removed.
- Default values for the Spam Protection and Security > Keyword Filter List on the Builder screen.

### Changed
- Addons not passing the requirements are not deactivated now.
- Updated jquery.validate library to 1.21.0.
- Updated stripe/stripe-php library to 16.1.0.
- Updated DOMPurify library to 3.1.7.
- Updated woocommerce/action-scheduler library to 3.8.2.
- Updated Chart.js library to v4.4.4.
- Smart tags are no longer processed in WordPress builders, such as Gutenberg, Elementor, Divi Builder, etc.
- Spam entries flagged through the Country & Keyword filters are now stored.
- Improved handling of duplicate stripe webhooks.

### Fixed
- Cloned Repeater fields were not visible in form confirmations when Ajax form submission was disabled.
- The country code was incorrect when the default flag was set in the Smart Phone Field with GDPR.
- RTL layout of the Repeater field on the front end.
- RTL layout of the Layout and Repeater fields in the builder.
- There was unnecessary space in the value of the HTML field on the Entry Print Preview screen.
- The Smart Phone field entry value was wrong in some cases.
- There was a potential infinite recursion in error handling.
- Improved performance on the Templates page in the Form Builder.
- Field labels were printed in the Order Summary table when the Hide Label option was enabled.
- The Likert scale field values were not exported if column names contained numbers.
- The update notice did not appear on the plugins page on WordPress.com.
- Order summary ignored some payment fields on multi-page forms.
- Resolved W3C errors and warnings reported for the Fancy fields.
- In some cases, adding a new account in Form Builder did not load the account data correctly.
- The currency symbol sometimes moved to the second line when the amount was too long.
- Table styles were broken in the Rich Text field smart tag.
- Improved translation handling for addon names and descriptions.
- Order Summary performance issue on large forms containing numerous payment conditional logic fields.
- Repeater cloned fields were not added to Resend Notifications.
- Warning for unsaved changes appeared upon visiting the Marketing tab when no changes were made.
- Form fields were lost when saving a form with addon fields when the addon was deactivated.
- Mapped First/Last Name sub-fields were replaced by another after the initial field was deleted.
- An extra field was displayed when WPForms were embedded using a shortcode in the Footer.
- Country selector was missed for the preview of the Phone field in the builder.
- The non-Latin characters were not supported for the AI Choices prompt.

## [1.9.1.6] - 2024-10-28
### Fixed
- The Dropdown field placeholder was disabled on the Divi Builder preview screen.
- When sending a form with an incorrect nonce field, no error was displayed.
- An extra field was displayed when a form was embedded using a shortcode in the Footer.

## [1.9.1.5] - 2024-10-23
### Fixed
- Order Summary table ignored some payment fields on multi-page forms.
- Update notice did not appear on the plugins page on WordPress.com sites.
- PHP warnings appeared with WordPress widgets.

## [1.9.1.4] - 2024-10-17
### Fixed
- Multiple sending of weekly summary emails.

## [1.9.1.3] - 2024-10-02
### Fixed
- The Repeater field had a drag-and-drop issue in the form builder.
- HTML tags didn't work in an agreement text of the GDPR field when a field's label was hidden.
- HTML tags in choices of the Checkboxes, Multiple Choice, and Dropdown fields were escaped and didn't work as expected.
- Update bubble notification was still showing up after plugin or addon update.

## [1.9.1.2] - 2024-09-27
### Fixed
- There was a conflict with the WooCommerce Subscriptions plugin.

## [1.9.1.1] - 2024-09-26
### Fixed
- Issue where addon update attempts failed, incorrectly reporting that the addon was already at the latest version.

## [1.9.1] - 2024-09-24
### Added
- State-of-the-art generative AI can help to build forms even faster.
- New supported currencies.
- New `wpforms_html_field_name` filter that allows modifying field labels in email notifications and on Entry Single/Print screens.
- Notice in the Form Builder when a user attempts to move a field with existing mapping to a Repeater field.
- Functionality to delete old spam entries automatically.

### Changed
- Improved the UI for multiple dropdown elements in various places of the admin area.
- Updated Stripe Subscription to use the plan name as the description.
- Notice in the WPForms > Settings > Payments admin page when a selected currency is not supported by Stripe.
- WPForms admin notices are now sorted by type.
- Improved the Modern Dropdown field UI across the Block and Elementor editors.
- Updated DOMPurify library to 3.1.6.
- Updated `stripe/stripe-php` library to 15.8.0.
- Improved RTL support of plugin admin pages.
- Improved compatibility with Full Site Editor and Gutenberg plugin.
- Removed extra spacing for Layout and Repeater with empty label.
- Improved performance on admin pages.
- Form Builder: Alt+S shortcut toggles the sidebar on Windows and Linux. Ctrl+F shortcut has been improved to always open search field.

### Fixed
- Fixed overlap issue between tooltip text and Country filtering dropdown options in Form Builder > Settings > Spam Protection and Security.
- Resolved W3C validation error for the Order Summary table.
- The Richtext field value had extra new lines in the Email Notifications and Confirmation page.
- Fixed RTL display issues for submit spinner and payment fields with quantity enabled.
- Corrected the WPForms disallow rule in the physical robots.txt file to ensure validity.
- Resolved pagination button issues for WordPress versions 6.6 and higher.
- Incorrect price was displayed in the Order Summary table for some currencies when the Single Item field with 'user defined' type was used.
- Improved mobile responsiveness of the price column in the Order Summary table.
- Rich Text Field in Preview Entry was shown as a plain text.
- "The cron event list could not be saved" error could appear in the debug.log file in certain cases.
- Fixed display of '+' and '-' buttons in repeater fields within OptinMonster popups.
- WPForms script was not defined in the Elementor popup.
- Fixed visibility issues with Layout and Repeater fields on View Entry and Print pages when hidden by Conditional Logic.
- Layout field on single entry view were ignoring compact view toggle setting.
- Compatibility with the Jetpack Boost plugin.
- Email notifications didn't have styles for tables inserted in the Content field.
- PHP notice generated on the Single Payment screen in some cases.
- There was a conflict between the default media uploader and the Rich Text field uploader on the Block Editor screen.
- Field label was always visible in single entry view and print preview.
- Search on WPForms –> Tools –> Scheduled Actions page redirected users to the Import Screen.
- The `wpforms_weekly_entries_count_cron` task was reporting an error in the debug log.
- Order of fields inside layout with rows display was incorrect for entry preview and confirmation.
- Predefined options hidden by Conditional Logic were displayed in Order Summary table.
- Resolved W3C errors and warnings reported for the Standard fields.
- The browser tab could crash if the WPForms block was used with patterns.
- Deprecation errors appeared in the debug.log while using AWeber Legacy API.
- The Order Summary text was not readable in some form themes when the `{order_summary}` smart tag was used in the Confirmation message.
- Complex fields had the shifted layout inside the single-column Repeater and Layout fields.
- Submit button hover styles were overridden in some themes and Elementor.
- Repeater and Layout fields were visible inside Entry Print field even when hidden by Smart Logic.
- The deny list option for the Email field was not working inside the Repeater field.
- Fields looked cropped when dragging inside/outside multi-column Layout or Repeater.
- The fields added by the `wpforms_email_display_other_fields` filter inside Layout and Repeater have not been added to email notifications.
- The Repeater field failed to function when the "Defer Non-Essential JavaScript" option was enabled in the Jetpack Boost plugin.
- The Layout field label was always visible in the Entry Preview and Confirmations.
- Page Breaks and Section Dividers toggles didn't work in the Field Settings menu on the Single Entry admin screen.
- The "Missing 'wpforms' dependency" error appeared on pages without a form.
- The Dropdown field was cut off on mobiles when nested in the Repeater field.
- Smart Phone field prevented form submission in some cases.

## [1.9.0.4] - 2024-08-23
### Fixed
- Unable to send a form with Constant Contact integration and fatal errors in the admin.
- The order of fields in Notifications was incorrect when using the Rows style field Layout.

## [1.9.0.3] - 2024-08-20
### Fixed
- Compatibility issues with menus and popups on Elementor.
- A fatal error with wp_remote_retrieve_headers occurred in CacheBase.php in some cases.
- Compatibility with the Jetpack Boost plugin.

## [1.9.0.2] - 2024-08-13
### Fixed
- Update Now button was not available in Plugin Details modal on WordPress Updates page in some cases.
- WPForms was not updated on WordPress Updates page in some cases.
- Fatal error could occur during update process in rare cases.

## [1.9.0.1] - 2024-08-08
### Fixed
- Issue where the WPForms widget was not available with the Avada theme.
- Compatibility issue that prevented the WPForms widget from being added with certain page builders.
- Entry fields could not be saved in some cases when Conditional Logic and Show Values were enabled in Choices.
- Issue where the Reply-To email field was missing in the email header when the Simple Contact Form template was used.

## [1.9.0] - 2024-08-06
### Added
- Modern Antispam protection for new forms.
- Support conditional logic in the Layout field and add the ability to render the label and description for this field.
- One column preset for the Layout field.
- The notification to check prices is added when the currency is switched.
- The new filter `wpforms_sanitize_amount_before` to filter a raw price amount before sanitization.
- The new filter `wpforms_sanitize_amount` to filter a sanitized price amount.
- Display the activation modal on addons form templates if the addon was installed but not activated.
- Conditional option to exclude today's date from the date picker.
- The new filter `wpforms_enable_form_data_slashing` to enable the form data slashing.
- The new filter `wpforms_field_file_upload_remove_webfiles_from_denylist_enabled` allows logged-in administrators to upload `.htm, .html, .js` files.
- The new filter `wpforms_frontend_js_header_force_load`allows the loading of JS assets in the header.

### Changed
- Improved performance on Entries admin pages, including Entries Search.
- Improved automatic recreation of custom database tables.
- Inactive addons now display their updates on the Plugins and Updates pages.
- Display a confirmation popup when clicking the "Empty Spam" button to prevent accidental clicks.
- Improved RTL support of plugin admin pages on desktop and mobile screens.
- Smart Tags for the Name, Date/Time and Address fields now allow retrieving partial data, such as Last Name or City.
- Improved layout of the Settings > Integrations page on small screens.
- Added notices for the Default value and Allowlist/Denylist settings on the Email field in case some values were invalid and have been removed.
- Improved "File Upload" field error messages to be more helpful.
- If both the Lite and Pro versions are installed and Pro is activated, the Lite version no longer has an activation link to avoid confusion.
- Improved the multi-select dropdowns UI across the Builder UI.
- Updated `stripe/stripe-php` library to v15.5.0.
- Updated `woocommerce/action-scheduler` library to v3.8.1.
- Allowed using the `&` symbol in Modern style Dropdown field choices.
- Install the Lite version when the Pro version is active is not allowed.
- Improved compatibility with the WP JobSearch plugin.
- Updated `jQuery.Validate` library to v1.20.1.
- Improved sanitization of the Website / URL field.
- Prevented addons' updates if the WPForms version doesn't match the required version.
- Updated addon compatibility error notices on the Plugins admin page.
- Updated `inputmask` library to v5.0.9.
- Disable the activation toggle for the addon that is not compatible with the core version.

### Fixed
- Stripe payment form couldn't be submitted in the Elementor popup preview.
- A fatal error occurred when the request to retrieve all addons was triggered by a non-authenticated user.
- The Trash, Duplicate, Restore, and Delete actions for templates and forms now display a notice with the correct type.
- Multiple Choice, Checkboxes, and Dropdown fields with empty values were displayed incorrectly in email notifications.
- Database error on a single network site after creating a form if the plugin was network activated.
- The W3C validation error was resolved for the Rich Text field.
- Fields reacted by hovering over them with the cursor on the Elementor editor screen.
- Modern Dropdown fields were not appropriately loaded on Block (Gutenberg) and Elementor editors.
- Some field margins were missing or incorrect on the Entry Edit page.
- Forms with hidden labels had a big horizontal scrollbar when displayed on mobile with RTL languages.
- Conditional logic affected the print page, which did not display hidden fields.
- The RTE field was broken in the Elementor editor preview when the left menu was collapsed.
- Changing layouts kept on adding multiple layout classes in the layout selector.
- Now, unique answers are supported in the Repeater Field.
- Rare exception with how we registered translations for download using the respective transient.
- It was possible to apply Gutenberg Themes for Lead Forms.
- PHP Warnings were displayed when user-duplicated forms were created before Form Pages/Conversational Forms were activated for the first time.
- Pre-populating fields from another form with confirmation redirect URL was not handling multi-select fields.
- The Gutenberg editor was not displaying the page title using Smart Tags.
- The {page_url}Smart Tag value was wrong on the Gutenberg editor's page.
- When all the provider's connections were removed, the check icon remained in the provider title.
- The fields hidden via Conditional Logic left empty div's inside a Layout field.
- The optional password field with enabled strength could not submit an empty value.
- The Smart Phone field has reported a validation error on valid Belgium and German phone numbers.
- The Repeater field Add/Remove buttons were invisible in some themes.
- Now, a warning popup is shown after adding or deleting the marketing addon connection.
- The position of the Next and Previous buttons in the Page Break Field was incorrect in RTL languages.
- The `{page_url}` Smart Tag was incorrect in the Divi builder.
- PHP deprecated messages were fixed on the Entry page for non-default file extensions.
- Modern Dropdown fields didn't preview correctly for multiple instances of WPForms block on the Gutenberg editor's page.
- The Repeater field clones on the mobile had no labels.
- The choice-based payment field Smart Tags didn't work in the prefilled URL.
- Data from the repeater was not displayed when exporting and editing an entry in some cases.
- In Dropdown, the & symbol was rendered as the corresponding HTML entity `&amp;` for Modern Style.
- The modern dropdown field was not loading correctly on the Elementor popup.
- Empty forms couldn't be submitted without enabling the "Minimum time for submit" setting.
- Incorrect site URL was used during the Lite to Pro upgrade.
- Switching to Live mode on the Payments Overview screen was impossible when all test payments were deleted.
- In some cases, the fields' order on the Entries Overview page was incorrect when the form was created from a Simple contact form template.
- A PHP error could be generated when submitting an imported Stripe payment form with the Address field configured in payment settings.
- Fields hidden by Conditional Logic could affect the Total field amount in payment addons.
- PHP Notices were logged when users visited a single entry page with empty values.
- Dropdown and Checkbox fields with multiple values were inline in email notifications.
- The Themes panel in the Block editor had a minor visual issue.
- On the Form Builder's Templates panel, two "Upgrade to PRO" banners were displayed in Lite and Pro (Basic and Plus licenses).
- Compatibility with OptinMonster when the multi-page form was inside the popup.
- Pressing the Enter key triggered the WPForms Insert Form modal in the Classic editor.
- Dropdown and phone fields in forms with the `inline-fields` class had cropped dropdowns on Safari.
- The checkbox field with only one choice was not marked as selected in the entry export.
- Payment quantity text was not centered on some themes.
- Some fields were visible in the email notifications even if they were hidden by Conditional Logic.
- Field labels set to be hidden were displayed in form entry previews.
- The Robots.txt file wasn't valid due to the WPForms disallow rule.
- Repeater empty fields were breaking the print preview layout.
- It was impossible to fill in the AM/PM date format for fields on mobile devices with enabled input masks.
- After embedding to the new page, the `{page_title}` Smart Tag was empty in the Block Editor (Gutenberg).
- Incorrect note text inside Repeater fields having a size.
- Conditional logic applied to the Repeater field was not reflected on single-entry views.
- The repeater field didn't work in the Elementor popup.

## [1.8.9.6] - 2024-07-09
### Changed
- Improved compatibility with OceanWP theme.

### Fixed
- Dropdown and phone fields in forms with the `inline-fields` class had cropped dropdowns.
- Button's hover color was wrong on the Ocean WP theme.
- Form couldn't be submitted when Cloudflare Turnstile anti-spam integration was configured.

## [1.8.9.5] - 2024-07-03
### Fixed
- Stripe payment wasn't created when the Credit Card field was optional and users paid through Google Pay / Apple Pay.
- The previously selected time of the Date & Time field was not correctly reset when selecting a new value.
- Fatal error was thrown on updating translations.
- Fields hidden with Conditional Logic were attached to notification emails if they contained calculation logic.

## [1.8.9.4] - 2024-06-27
### Added
- Conditional option to exclude today's date from the date picker.
- New filter wpforms_sanitize_amount_before to filter a raw price amount before sanitization.
- New filter wpforms_sanitize_amount to filter a sanitized price amount.

### Fixed
- The Repeater field Add/Remove buttons were invisible in some themes.
- The Fields hidden via Conditional Logic left empty div's when inside a Layout field.

## [1.8.9.3] - 2024-06-24
### Fixed
- Fatal error was thrown when submitting a form with Akismet anti-spam protection containing a Repeater field.
- When having more than one Notifications per form, the CC field wasn't working correctly.

## [1.8.9.2] - 2024-06-18
### Fixed
- Reply-to field was not returning the correct email address.

## [1.8.9.1] - 2024-06-13
### Fixed
- Fatal error was thrown if the Email > Carbon Copy option was enabled and CC field in Notifications contained multiple email addresses.
- If the form had multiple notifications configured, first CC (carbon copy) value was applied to all notifications.

## [1.8.9] - 2024-06-11
### Added
- Repeater field that enables creation of flexible and dynamic forms to collect information in a convenient & variable format.
- Individual entries can now be manually marked as spam.
- Complex fields now can have separate error messages for each field.
- Recommended, New, and Featured addons are now displayed first on the addons page.

### Changed
- The Campaign Monitor, ConstantContact, GetResponse and ConvertKit logos were updated.
- Users can now see the category and subcategory of the selected template on the Setup panel.
- If Akismet is installed and configured for the form, marking entries as spam or not spam helps Akismet learn.
- Improved the behavior of Tools > Logs page and settings controls.
- Improved RTL layout of Entries Overview page on small screens.
- Improved compatibility with the Hello Elementor theme.
- Process empty selected values for Choices, Checkbox, and Dropdown fields when Show Values option is selected.
- Choices.js library has been updated to v10.2.0.
- Modern multiple select field with search enabled now is more user-friendly across the admin area.
- Improved rendering of Payment Fields according to W3C requirements.
- Always display templates added by addons, even if the addon is not installed or activated.
- The form builder now hides the placeholder label for Image and Icon choices when left empty, while retaining the placeholder for Payment Choices and Checkboxes to maintain consistency with frontend behavior.
- Improved the process of Custom Captcha field validation.

### Fixed
- Password field with Strength option turned on generated PHP Deprecated notices when submitting the form.
- Entry Export search by payment field value with currency symbol worked incorrectly for some currencies.
- Incorrect alert modal was shown on the subscription plan removal in some cases.
- Various RTL problems on the form builder screen.
- The minimum payment amount for the Single Item field was not functioning correctly with currencies that use a comma as a decimal separator.
- Upload field values were broken into two lines on the Single Entry admin page.
- Validation error for the Postal code of the Stripe Credit Card field displayed twice.
- Inconsistent spacing of Dropdown field in different browsers on desktop and mobile.
- There was a scroll jumping when switching between the 'Text' and 'Visual' tabs in the RichText field on mobile devices.
- A popup about the form containing unsaved changes was displayed after switching to Marketing tab in the Form Builder even if the form was not modified.
- PHP warnings were reported on Entry Edit page in some cases.
- Stripe Credit Card field had incorrect placeholder color with Classic Markup.
- Rich Text field text styles drop-down had unreadable text with dark styles of the Twenty Twenty-Four theme.
- Updated the WPForms Challenge to only start counting when you actually begin creating a form on the Forms Overview page.
- The coupon column in the Total field Summary had an incorrect border color with Classic styles applied.
- User templates were not deleted on plugin uninstall.
- The radio of the Multiple Choice field wasn't centered in Firefox.
- Conditional Logic in the Form Builder wouldn't allow the creation of multiple marketing connections.
- Stripe processing error occurred on a multi-payments form when all credit card fields were hidden by conditional logic.
- The notice about Custom Captcha being included in the WPForms plugin was not displayed on Network Administration Screens.
- Console errors occurred in the Block Editor when the Pro license key was empty or expired.
- Notices about Zapier disconnections could duplicate when creating a form from a template.
- Color of validation errors was incorrect for the Stripe Credit Card field when Payment Element mode was used.
- Placeholder of the State sub-filed didn't show for the International Address field.
- Additional padding was added for the form title on the Forms Overview page on mobile.
- "Select your layout" setting wasn't shown when a layout was selected.
- The plugin update process redirected to the Update page and did not redirect back to the Plugins page after the update.
- The fetching of the new plugin version number and new plugin description has been run not-synchronously.
- MySQL errors occurred when creating a table in some unique configurations.
- Multiple Choice field with Icon Choices could not be selected in Firefox after reloading the page.
- Inline javascript code could be parsed improperly and displayed as text on top pages for some configurations.
- Cached token was not updated properly.
- The Spinner layout of the Save button in the Form Builder was not centered.
- In some exceptions, one-time payments appeared in the Stripe dashboard even though a payment form wasn't submitted.
- The "Empty Spam" button removed only currently visible entries, not all of them.
- Adding a table to the Rich Text field resulted in additional HTML spaces appearing in the email notification.
- Email notifications were not sent when a subject was empty after smart tag processing.
- Performance improvement of spam entry deletion.
- PHP warnings might have occurred in some cases on PHP 8.0+.
- File Upload field required to upload files one more time when a form was submitted with a failed captcha.
- Upgrade to the Pro link had wrong styling on Bluehost hosted sites.
- WPForms block in the editor showed an error when the selected form was trashed or deleted.
- Some Stripe transactions were refunded almost immediately as the transactions were labeled fraudulent.
- The validation process of Number Slider field could throw a fatal error on PHP 8.0+.

## [1.8.8.3] - 2024-04-26
### Changed
- Updated jQuery.Validate library to v1.20.0.

### Fixed
- Screen Options on the Forms Overview and Entries Overview pages could cause PHP error in rare cases due to conflict with 3rd-party code.
- Post Statuses on legacy Nav Menu management page could cause PHP error in rare cases due to conflict with 3rd-party code.
- Users couldn't duplicate their forms.

## [1.8.8.2] - 2024-04-23
### Fixed
- Improved handling of corrupted payment submission data.
- Fixed renaming of custom themes on the Full Site Editor.

## [1.8.8.1] - 2024-04-17
- Fixed console error on the `Widgets` admin page.

## [1.8.8] - 2024-04-16
### Added
- Forms can now be saved as user templates for future use.
- New `Price Display` option was added for Single Item payment field.
- Shipping and Billing addresses can now be configured on the Form Builder > Payments > Stripe screen.
- New filter `wpforms_integrations_stripe_api_common_create_plan_name` to filter Stripe subscription plan name.
- New filter `wpforms_integrations_lite_connect_api_request_timeout` to filter Lite Connect request timeout.
- New filter `wpforms_pro_integrations_lite_connect_api_batch_size` to filter batch size for retrieving site entries from the Lite Connect API.
- New `Row/Column` display option was added for the Layout field.
- New styling/theming settings in the Block editor.
- New context menu in the Form Builder for quick actions.

### Changed
- New design for the Email Summaries email template with a weekly total and entry submission trends.
- The state of selected stat cards on the Payments Overview chart is preserved when applying date filtering.
- Updated `stripe/stripe-php` library to v13.15.0.
- Updated `woocommerce/action-scheduler` library to v3.7.2.
- Updated DOMPurify library to 3.0.9.
- Updated intl-tel-input library to v20.1.0.
- Adjusted notifications on the empty forms screen.
- HTML tags are allowed in the Order Summary for the Total payment field.
- Improved the logic of displaying valid provider connections in the form builder.
- When the entry is marked as not spam, submit data to Akismet for learning and help make the Web a better place for everyone.
- Improved error handling when creating or updating a form.
- Improved fields layout on the frontend for better user experience on mobile devices.
- Bring the frontend markup of the form more in line with the W3C standards to reduce validator errors.
- Removed remove file action.

### Fixed
- Automatic and unintentional popup of the "What's New" modal on the WordPress admin dashboard.
- Various visual issues with the "What's New" modal.
- Various RTL problems in the admin dashboard, form builder and a form preview page.
- Various responsive issues on admin pages.
- The Paragraph field was allowed horizontal resizing.
- Make sure we output valid robots.txt file rules if the file is empty.
- PHP notices were thrown in some cases when Stripe subscription renewals were created.
- Customer email was shown instead of customer name on the Payments Overview screen for Stripe subscription renewals in some cases.
- Forms having many fields with conditional logic loaded slowly on the frontend.
- The builder sidebar was hidden on the context menu edit actions.
- File Upload field keyboard issue on some mobile devices.
- Fatal error was thrown on the frontend with corrupted form data.
- `0` (zero) as a choices field raw value was not saved.
- The payment single field had the wrong spacing with enabled quantities.
- JavaScript error when conditional logic "Show if not empty" is applied to a dropdown field.
- Various layout and validation issues on Edit Entry page.
- Long placeholders being broken into multiple lines after Safari 17.3.1 update.
- Media upload did not work in some cases on mobile devices.
- Placeholder option was hidden for the Single Item field with 'user defined' type.
- Incorrect prices in the Order Summary table when items in the Checkbox Items field had the hyphen symbol.
- Improved Select a date range field on mobile devices on the Form Entries page.
- Entries search didn't work for non-UTF8 charsets.
- Modern multiple select fields with long placeholder text overlapped a drop-down arrow.
- The password field overlapped the Phone field dropdown.
- Infinite loading button was shown on mobile devices in some cases.
- Incorrect value was displayed for the Date / Time field with the Time format and configured Limit Hours on the Edit Entry screen.
- Multisite activation: plugin should stay activated on a single site after user activated it on a network level.
- It was impossible to modify entry values of some fields on the Single Entry screen using the `wpforms_html_field_value` filter.
- After updating a form entry, the date format of the modified date was different.
- Incorrect value was displayed for Number Slider field in case of using multiple {value} tags.
- There was a race condition with invisible reCaptcha v2, preventing form submission in some edge cases.
- Elementor widget styles were broken due to a conflict with the Gutenberg block.
- In some cases addon was not marked as connected in the form builder despite having configured connection.
- Time showing incorrectly on the Edit Entry screen for the Date / Time field when the time format was 24h.
- Edited entry data was not saved on some server configurations.
- Some unnecessary inline styles were applied for email notifications with HTML tags.
- Payment fields weren't reflected properly in the Order Summary table in some cases.
- The content field had a visual issue when the expanded editor was used in some cases.
- WPCode Install/Activate modal and Entries Education Modal now look better on mobile screens.
- `{author_*}` and `{page_*}` smart tags were returning incorrect results in some cases.
- The form was not sent if it was in an Elementor popup with a phone field.
- Incorrect styles were applied for "Order Summary" table in some cases.
- Lazy-load YouTube video on the Settings > Themes panel to improve performance of the Form Builder.
- Advanced settings tab layout of the Date / Time field was partially broken in Firefox browser.
- Uncaught Error when attempting to fetch remote data and remote request failed.

## [1.8.7.2] - 2024-02-29
### Changed
- "What's New" modal should be displayed based on the major version of the plugin.
- Improved Akismet integration efficiency.

### Fixed
- Antispam token was passed as a simple form field, not protected from spam bots.
- PHP warning was thrown in case of anonymous form submission when User ID smart tag was used.
- Image positioning in the "What's New" blocks wasn't always correct.
- The recommended plugin block in the Dashboard widget could not be dismissed.
- Modal windows were not displayed on small screens.
- The animation for opening the "What's New" modal worked improperly when the modal had small content.
- The background was not entirely dimmed when scrolling the "What's New" popup.

## [1.8.7.1] - 2024-02-22
### Fixed
- The form submission was not working if the customer used a snippet for the phone field.
- The form submission triggered an error on sites with long-term page caching.
- Page URL smart tag value was incorrect in some cases.

## [1.8.7] - 2024-02-20
### Added
- Product Quantity can now be configured for Single Item and Dropdown Items payment fields!
- A new Gutenberg option for selecting Page Break color.
- The Announcements block in the Community page.
- New way to expand the Form Templates subcategories in the templates list sidebar.
- Support for locations of Form Pages and Conversational Forms.
- New splash screen outlining notable features and changes in the release.
- The user can see an overview of what they are purchasing by enabling the Order Summary for the Total payment field.
- New `{order_summary}` smart tag.

### Changed
- Improved compatibility with Twenty Twenty-Three theme.
- Improved plugin activation on WordPress multisite setups with both Lite and Pro versions installed.
- Improved support of sites hosted in the Azure platform using IIS.
- Updated DOMPurify library to 3.0.8.
- Removed `jquery-confirm` library in favor of jQuery.Confirm Reloaded drop-in replacement.
- Spam protection token is valid now for 3 days instead of 2.
- Spam protection token is no longer loaded with JS to avoid fails caused by script errors.
- Storing spam entries is now enabled by default for new forms.
- Users with limited capabilities are allowed to view the Forms Templates and Addons pages.
- The Custom Captcha field is now available and the respective addon is no longer needed.
- Updated `intl-tel-input` library to v19.2.16.
- Updated `tijsverkoyen/css-to-inline-style` library to v2.2.7.
- Updated `symphony/polyfill-iconv` library to v1.19.0.
- Updated `symphony/polyfill-mbstring` library to v1.19.0.
- Updated `woocommerce/action-scheduler` library to v3.7.1.
- Updated `stripe/stripe-php` library to v13.9.0.

### Fixed
- Some background actions could fail if triggered by WP-CLI via server cron.
- Checkbox fields with Dynamic Choices were exported incorrectly if the labels were previously modified.
- Items of the unordered list in the Entry Note had no bullets.
- Limit Length validation was working incorrectly for the Paragraph Text field if the field display was managed by Conditional Logic.
- Fatal error may occur in rare cases during migrations if they were triggered manually.
- Read-only Number fields should not display spin buttons.
- The File Upload field was incorrectly displayed when placed within the Layout field.
- The Icons Choices field with a Large size was not centered in the Block Editor and Elementor.
- Rich Text field menu elements were visible through the Phone field's dropdown menu.
- Two messages appeared when clicking on the reCAPTCHA field after searching the fields in the Builder.
- Tables in emails were visually broken on mobile phones when the Compact email template was used.
- A form with a long title expanded the form selector dropdown in the Block Editor.
- The entry modification date was presented with a doubled timezone offset.
- Some payment-related elements were aligned to the left when a right-to-left language was used.
- Rich Text was displayed incorrectly when using Elementor after the Block Editor.
- The long field names were breaking the Entries List Table layout.
- CSS Styles were not applied if Global Colors were already selected in Elementor Builder.
- Signature field background color was incorrect in the Block Editor with Modern markup.
- Payment method details were not stored for Stripe renewals.
- In some cases, transients were not deleted on entry deletion.
- The template page had style issues in the German language.
- The Elementor popup preview had broken WPForms styles.
- Forcing the license key refresh worked with significant delay due to caching.
- In some situations, payment amounts were improperly sanitized.
- Some modals across the admin area were not responsive and did not fit on smaller screen sizes.
- Currency symbol could wrap into the next line on the Entries Overview page.
- Templates' cache wasn't updated after the plugin update.
- RTL support for WPForms Settings page.
- RTL support for the Form Builder.
- Some frontend fields were improperly rendered for RTL.
- The user interface had different other issues when RTL language was in use.
- The Form Builder settings screen had multiple visual issues when RTL language was used.
- The PayPal button was overlapped by modern Dropdown items.
- AJAX calls didn't work on servers with empty `$_SERVER['HTTP_REFERER']` value.
- PHP warning was thrown in rare cases when using a certain template with conditional logic and Save and Resume functionality.
- Improved Entries overview page display on mobile devices.
- Improved Forms overview page display on mobile devices.
- Improved Tools pages display on mobile devices.
- Custom Captcha settings were duplicated on the Form Builder when the field was added through the Settings > Spam and Security screen.
- Jetpack has been adding its custom buttons to the Content Field editor.
- Localization issues were present on the Get Started screen.
- Selected values were not displayed on the entry view and print pages if custom values were enabled via `wpforms_fields_show_options_setting` filter.
- Rich Text field was not rendered properly in the Elementor popup.
- Subscriptions made by the Stripe Link payment method before 1.8.6.
- Some non-optimized MySQL requests locked the database for seconds on huge sites with thousands of tables.
- The Appearance of multiple dropdown values was incorrect.
- Some information was missing if Smart Tags were processed in the background via cron.
- The recent Chrome version for Windows was not displaying the custom scrollbars correctly.
- Payment fields were missing from the search filter on the Entries Export.
- `wpforms_plaintext_field_value` filter was unavailable since 1.8.5 version.
- Images inside the Content field were incorrectly overlapping other fields in the Single Entry Page.
- Date Range filter for Entries Export could stop working after resetting the filter if the previous search returned no results.
- The HTML field had incorrect spacing in the Single Entry Page.

## [1.8.6.4] - 2024-01-31
### Fixed
- Term notice was removed under the Stripe Credit Card field when Payment Elements were used.
- An additional spinner appeared when the Setup panel button was clicked again.
- The first year in date dropdown has been set to 1 year ahead.
- Overflow of `img`, `video`, `canvas` and `svg` tags has been set to `clip` by default, as recommended by Google PageSpeed Insights.

## [1.8.6.3] - 2024-01-19
### Fixed
- The Name field was not clickable with Classic Markup and Base Styles.

## [1.8.6.2] - 2024-01-16
### Fixed
- PHP warning was thrown for legacy subscription Stripe payment form.
- PHP warning was thrown while connecting the Jetpack plugin account.
- The layout of some fields was broken on the Entry Edit page.
- Likert Scale with single-row rating scale were exported incorrectly.

## [1.8.6.1] - 2024-01-10
### Fixed
- A fatal error was thrown in rare cases when running background jobs due to a conflict with some 3rd-party plugins.
- An Error Handler was throwing a TypeError in some rare cases.

## [1.8.6] - 2024-01-09
### Added
- New column selector and column reordering on the Forms Overview and Form Entries page.
- New right-click context menu in the Form Builder.
- Forms can now be imported programmatically.
- New Empty Trash button for table navigation on the Entries Trash view screen.
- New filter `wpforms_pro_admin_entries_export_skip_not_selected_choices` to skip not selected choices in the entries export.
- Payment Checkboxes fields can now be exported as separate columns.
- New minimum price option for the Payment Single Item field that can help protect your forms against card testing by fraudsters.
- Caching to the templates list markup on the Templates page and in the Form Builder for improved performance.
- Customer name can now be configured on the Form Builder > Payments > Stripe screen.
- Dark Mode support for email notifications. Users are now able to customize styling for each appearance theme.

### Changed
- The `intl-tel-input` library has been updated to v18.3.3.
- Improved compatibility with the Apple Pay feature for Stripe payments.
- Updated the design of the Addons page in the admin dashboard.
- Delete All button renamed to Empty Trash on the Entries Trash view screen.
- Improved the look of the View Options menu on the single entry view page.
- Improved compatibility with latest versions of Divi theme.
- Improved compatibility with OceanWP theme.
- Improved compatibility with the Hello Elementor theme.
- Improved styles of various Lite Connect settings.
- Improved behavior of various Email settings on the WPForms Settings page.
- Improved form templates search.
- Significantly improved performance of the Form Builder when opening existing forms.
- Display a link to the manual installation in case automatic addon installation fails.
- Restrict media files to only valid image types for the Header Image field on the Email page, and Image Choices options in the Builder.
- Improved handling of empty choice labels of the Dropdown, Checkboxes, and Multiple Choice fields.
- Improved various messages across the admin area.
- Email templates support for Lite Connect imported entries notification.
- Custom Date Range picker on Export tab can now be cleared.
- State and Country subfields of the Address Fields now have no default value selected on the frontend.
- Styles customizations of email notifications on the WPForms Settings page can now be previewed without saving them.
- Optimized the entry export process to prevent memory issues when exporting many entries for complex forms.
- Stripe library updated to the latest version.
- When WPForms plugin is downgraded, a helpful warning message is now displayed.
- Improved Section Divider field appearance.
- The Authorize.Net logo was updated.

### Fixed
- Star icon misaligned on the single entry view page.
- Lead Forms notice displayed on the Print Preview page if the entry was edited manually.
- Remove empty Page Break field from the last page if previous page button is disabled.
- Pressing Apply with no selected action on the Payments Overview page triggered WordPress' die screen.
- Elementor widget preview is not properly updated after editing the form in the builder popup.
- Rich Text field is rendered incorrectly on Elementor editor preview.
- Plugin prefix added to all action links on the plugins page to prevent collisions with third-party CSS code.
- Stripe Credit Card field styles are not applied in WordPress Site Customizer.
- Dashboard widget displayed incorrect entry counts for users with access restrictions.
- Stripe Elements field had too much spacing around the Submit button with Modern styles applied.
- Sorting forms by last entry worked incorrectly in some cases.
- Trashed forms not removed during the plugin deletion process.
- An empty value from the Dropdown field is saved if the choice with empty label is selected.
- Multiple notices reminding to enter your license key could be displayed at the same time on Addons page.
- Some styles were incorrect for the Form Selector widget in Block Editor, Elementor and Divi.
- Confirmation Page dropdown is not completely visible in some cases on smaller screens.
- PHP warning about undefined country filter key.
- Header Image Size dropdown appeared on the Email Settings page even though there is no image set for the Email Header.
- Scroll to the error message when the form is submitted with an error not working in some cases.
- Some 3rd-party plugins could be included in the translation files check.
- Email notification not rendered correctly if multiple smart tags are used.
- Inconsistent display of the currency value on existing Entry view and print if the currency has been changed.
- PHP deprecation warning logged when the Weekly Summary email is triggered via cron on PHP 8.2.
- Regular Stripe card number field not inheriting colors correctly from the Lead Forms settings.
- The encoded value of the Password field did not work with WPForm's custom User Login Page.
- Date and time format in Entry Export should not contain `at` to be recognized as a cell of date type.
- Exported Address field values contain incorrect values if the form is submitted with empty address data.
- Dropdown preview in the Form Builder not updated correctly.
- Entry Preview field unreadable on some default Block themes.
- Fields and a submit button not aligned properly on single line form layout.
- Checkbox and multiple dropdown values displayed in one line with new email templates.
- List of countries not fully displayed in the phone field when editing an entry.
- Do not display the "Install and Activate" button on the Geolocation and Coupons pages for Lite users if plugin installation is not allowed.
- Read-only Number fields should not display spin buttons.
- Previous button not displayed in certain cases in the Form Builder when the Entry Preview field is added.
- Incorrect error text displayed when uploading a file of an illegal format in the Form Builder.
- Incorrect error messages displayed for the required Payment Total and Stripe Credit Card fields.
- Prevent form pagination if the form is invalid.
- PHP Warning on the Form Entries admin page when non-standard date format is used.
- Date/Time fields in narrow columns displayed incorrectly in the Form Builder and Divi Builder.
- Field validation error icon positioned incorrectly when a form inherited content centering from the theme.
- Email addresses containing special characters are incorrectly validated against allow/deny list.
- Fields with subfields displayed incorrectly on the frontend in latest Safari and other browsers using WebKit.
- Email notifications using Plain Text format has some special characters that are converted into their HTML entities.
- Stripe integration with incomplete configuration generates console errors on the Conversational Forms page.
- JavaScript deprecation notices in the browser's console when the Bar graph style is used on the Payments or Entries Overview pages.
- Richtext field list styles affecting list styles in other instances of TinyMCE editor.
- Stripe subscriptions paid by Link were unable to be renewed.

## [1.8.5.4] - 2023-12-27
### Changed
- The `Chart.js` library has been updated to v2.9.4.

### Fixed
- Security fixes.
- The date format in the Chart tooltip does not consider site settings.
- Email Summary header image did not honor max width setting.
- Highlighted integration on Settings > Integrations tab no longer locks other integrations after page reload.

## [1.8.5.3] - 2023-12-13
### Fixed
- Better compatibility with default Block themes.
- Form Embed Wizard was loaded on the YOOtheme Builder page.

## [1.8.5.2] - 2023-11-21
### Fixed
- Weekly Summary email used plain text formatting when one of the new email templates was selected on the WPForms Settings > Email page.
- There was no way to customize a footer text in email notifications when one of the new email templates was selected.
- Email template specified on a per-form/notification basis wasn't respected when the Plain Text template was selected on the WPForms Settings > Email page.
- First paragraph's bottom margin was missing in new email notification templates.
- Custom date range selection was hidden on the Tools > Export page for entries coming from forms without any payment fields.

## [1.8.5.1] - 2023-11-14
### Fixed
- There was a conflict with 3rd-party plugins that use the Stripe PHP library.

## [1.8.5] - 2023-11-08
### Added
- New email templates are ready to use!
- Email template can now be customized and previewed on the Settings.
- Allow an email template to be specified on a per-form/notification basis.
- Added the ability to trash entries instead of directly deleting them.
- Prefix all 3rd-party libraries to avoid compatibility issues with other plugins using different versions of the same libraries.
- Entry export now displays payment details separately from other form fields.
- Entry export now allows exporting only entries with certain status(es).
- Multiple choice entry values can now be exported as separate columns.
- Added two new links, Form Edit and View Entries on the WPForms Block in Gutenberg.
- Added new filter making it possible to customize styles for the Stripe Credit Card field when Payment Elements are used.
- WPCode integration.

### Changed
- Updated DOMPurify library to 3.0.6.
- Improved significantly the performance of frontend email validation.

### Fixed
- Addressed a few compatibility issues and deprecation errors with PHP 8.1 and newer versions.
- Stripe Credit Card field error was not visible on multipage forms in some cases.
- Search didn't work on the Form Templates screen if a template name contained the dash symbol.
- Stripe Credit Card field duplicate button was visible in the Form Builder in some cases.
- Stripe webhook requests triggered a PHP error and returned the wrong response in some cases.
- The single entry view was broken when HTML field had broken syntax.
- The entry meta box on the single entry view page was broken with IPV6.
- Image choices had some styling glitches in the builder preview.
- Akismet protection didn't work when Email Confirmation was enabled for the Email field.
- Translated strings weren't shown in the WPForms block in some cases.
- In rare cases Turnstile Captcha was not displayed correctly when it expired and was refreshed.
- Empty pages on multipage forms are no longer displayed if all fields are hidden with conditional logic.
- The attached files were not deleted from the Media Library when deleting spam entries.
- Some styles were missing for the File Upload field in the Divi page builder.
- The rich text field elements had alignment issues on certain pages.
- Custom styles were overwritten for the Stripe Credit Card field when the Modern Markup setting was used.

## [1.8.4.1] - 2023-10-24
### Fixed
- A fatal error was thrown when using the WP-CLI command with the --context=admin parameter.
- Stripe assets were loaded on every page when the Elementor plugin was activated.
- Resized images in Image Choices were displayed in their original sizes inside Notifications.

## [1.8.4] - 2023-09-26
### IMPORTANT
- Support for PHP 5.6 has been discontinued. If you are running PHP 5.6, you MUST upgrade PHP before installing WPForms 1.8.4. Failure to do that will disable WPForms core functionality.
- Support for WordPress 5.4 and below has been discontinued. If you are running any of those outdated versions, you MUST upgrade WordPress before installing WPForms 1.8.4. Failure to do that will disable WPForms core functionality.

### Added
- Statuses of Stripe payments can now be synchronized through webhooks!
- Users can now perform payment refunds, subscription cancelations, and more for Stripe payments.
- Payments can be filtered by type, gateway, and status on the Payments Overview page.
- New stats added to the Payments Overview chart: Total Refunded, New Subscriptions, and Subscription Renewals.
- When searching for forms on the Form Overview page, you can use a form ID now.
- There is a new "Latest entry" date column on the Forms Overview page which is sortable.
- There is a new Advanced Options tab for the Hidden field, available in the Form Builder.

### Changed
- WPForms Challenge text is improved to be more clear.
- The `intl-tel-input` library has been updated to v18.2.1.
- Form templates are now ordered by creation date in ascending order.
- Styles for the Stripe Payment Links are improved.
- Notice text colors in the Form Builder are updated.
- Number slider behavior is improved.
- On the Forms Overview page, the Created column is renamed to Date. Now it displays the date and time when the form was updated.
- Admin pages were updated to use a new unified Design Language.
- Stripe One-Time and Recurring payments can be enabled and configured separately for new forms.
- The Hidden field's Default value and CSS classes options were moved to the new Advanced tab.
- It's now more obvious in the Form Builder preview pane that the Hidden field label is not visible to end-users.

### Fixed
- The Style Settings widget was not permanently disabled for Lead Forms.
- With more than one notification in a form, some Reply-to emails defaulted to the site admin email.
- WPForms block did not get a list of forms dynamically.
- After updating a form entry, the date format of the modified date was different.
- Error message broke vertical alignment on Date/Time field.
- Layout fields had double vertical spaces.
- Very long tag names in the Manage Tags modal on the Forms Overview page were not wrapped.
- Disabled inputs looked different in the Form Builder > Notifications panel for the "From EMAIL" and "From NAME" options.
- A splash screen was displayed when all payments were moved to Trash, preventing the ability to restore trashed payments.
- The Smart phone field dropdown was cut off on the Entry Edit page.
- Dynamic choices of custom taxonomies (tags) for the Checkboxes field were displayed incorrectly under some conditions.
- Stripe Credit Card field error was not visible for multipage forms in some cases.
- WPForms Challenge welcome pop-up was displayed above the splash screen on tablets.
- Notices were generated in the `debug.log` file for a form with Lead Forms.
- The form submission "Send" button was not working correctly on click when Invisible Captcha had an invalid key.
- The Name, Address, and Password fields treated value `0` as empty.
- HTML-ENTITIES encoding threw a deprecation warning on PHP 8.2.
- An irrational scrolling occurred when quickly adding multiple fields in the Form Builder.
- Rows height in the Entries Overview table were inconsistent.
- The Date/Time field produced notices in the `debug.log` file under certain conditions.
- Fields with subfields were rendered differently in the Form Builder Preview pane and on the front end.
- Activation of addons on the Addon page did not return proper status.
- Rich Text field's validation error had an incorrect placement.
- Stripe fields were misplaced in the Block Editor form preview with Lead Forms.
- Multiple Modern Dropdown field value was not centered in the Modern Markup.
- Page change didn't work on Multipage forms inside the Elementor popup.
- Bullet points were displayed for the country code list in the Phone field with the Divi theme.
- The Entries Overview table display was improved when having more columns.
- Failed payments were counted in the Total Sales chart.
- Users were able to view trashed payments.
- Splash screen was displayed when all payments were moved to Trash.
- An incorrect currency of already processed payments was displayed when the global currency setting was changed.
- It was possible to export empty payment data for entries into the .csv/.xlsx file.
- There was an empty form name in the Single Payment details metabox if a payment form was deleted or no longer editable.

## [1.8.3.2] - 2023-08-15
### Fixed
- Addons' loading logic had a flaw preventing them from being properly loaded when license didn't match.

## [1.8.3.1] - 2023-08-11
### Fixed
- There were situations when Stripe Credit Card field wasn't working properly in Elementor.

## [1.8.3] - 2023-08-08
### Added
- New `{site_name}` smart tag.
- Spam entries are now stored in the database and can be reviewed on the Entries page.
- Fields in the Form Builder can now be searched by name or related keywords.
- New settings that allow users to toggle different fields on the single entry view page.

### Changed
- Adjusted error message for Stripe subscription payment failure.
- Elementor integration updated and improved.
- Improved cache busting of entry counts on the Dashboard widget.
- The Dashboard widget now displays counts with entries that are submitted today.
- Anti-spam processing significantly improved.
- Various notifications for users without required permissions have been improved.
- Updated DOMPurify library to 3.0.5.
- Improved handling of "entries disabled" state on the Entries Overview page and in the Dashboard widget.
- Sidebar in the Form Builder now can be collapsed or expanded with a `Ctrl + T` keyboard shortcut.
- Updated Icon Choices Font Awesome library to 6.4.0.
- Improved empty states for blocks/widgets on Gutenberg and Elementor editor.

### Fixed
- Submit button font family was not inherited from theme styles.
- Offer to install or activate Custom Captcha addon when adding it to the form via the Form Settings > Spam Protection and Security screen.
- Incorrect field settings panel opening when adding Custom Captcha field from the Spam Protection and Security screen.
- No spacing between the field label and the field on Settings pages.
- Handling of string to array conversion type error in rare cases when the option in the database contained malformed value.
- Improved the preview for the Dropdown choices with HTML tags in the Form Builder.
- Improved handling of redirects on the Entries pages with some configurations.
- Stripe Payment fields previously ignoring "Include Form Styling" setting.
- Content fields with conditional logic enabled not showing in the notification email.
- Handling JavaScript errors and PHP Notices when using missing fields in Conditional Logic.
- Mis-alignment of Country subfield in the Address field.
- Improved responsive styles for multiple choice controls on the Settings pages.
- Removed redundant space between Stripe credit card sub-fields when sub-labels are hidden.
- Handling console error on post/page edit screen when not connected to Stripe.
- Handling a PHP Notice that was generated when the legacy API is used for Stripe payments.
- Revised link to Comprehensive Guide in the Elementor WPForms widget.
- Removed a console error when a Rich Text field was used with Form Locker.
- Conditional Logic "IS NOT" rule not working correctly if the value was equal to 0 (zero).
- Modern style Upload fields were not highlighted when an error occurred.
- Akismet anti-spam check could be skipped in certain cases.
- Stripe Payment field displaying a warning sign with an empty error message when card validation failed.
- Resend notifications link was not disabled when "completed payments" notifications were enabled.
- Hierarchical Dynamic Choices list that resulted in a PHP timeout error when the list was more than 3 levels deep.
- CAPTCHA badge preventing the Divi Visual Builder preview from loading.
- Inconsistent email validation between front-end and server.
- Form Location title or slug occasionally not updating after updating a post.
- Buttons in the confirmation modal that were not aligned correctly if they didn't fit in one line.
- Legacy Credit Card's Security Number field not being aligned with other fields.
- Handling of different Classic/Modern file upload and Submit button combinations.
- Images in the Rich Text Editor could fail to display because of special characters.

## [1.8.2.3] - 2023-07-18
### Changed
- Admin notice content and design is improved.
- The library used for the modern phone field is updated to 18.1.4.
- We optimized the Help screen performance within the Form Builder.

### Fixed
- The query string rewrite module from the 7G Firewall plugin was conflicting with the WPForms block in the Block Editor.
- When the Stripe Links details were not filled, it was still possible to go to the Next page inside the multipage form.
- Payment fields were not inheriting a newly updated currency from the WPForms Settings > Payments page.
- When the multipage form was submitted, users saw duplicated errors (if relevant) on a page.
- The multipage form did not return to the first page when a general AJAX error occurred.
- When duplicating a field in the Form Builder, the options panel for the newly duplicated field was not consistently active.
- WPForms admin area was using a site language instead of the currently logged-in user language if languages were different.
- The select-entry checkbox and entry actions were hidden if entries didn't have editable fields.
- When an email field contained long words without spaces, words were not properly wrapped.
- On the Settings > Integrations page, when a section heading was clicked more than once in quick succession, the layout for adding an account could have been broken.
- Accessibility: in Safari it was not possible to change the value of the Rating field with just the keyboard arrow keys.
- Form settings were not reflecting new template settings when switching those templates.
- Form Pages and Conversational Form permalinks were not updated to reflect template settings.
- WPForms Challenge pointers were overlapping text labels in some languages.
- The "Delete All" link on the Entries List did not work as expected when the entries were filtered by date or using entries' search.
- Code challenge did not show the correct step number on existing forms.
- In some cases, the page with a form on the front end was not scrolled to the error field.
- The Dropdown border width was wrong when the input was smaller than the dropdown.
- It was possible to resize the Paragraph field larger than the containers.
- Empty option was replaced with the default one for a duplicated dropdown.
- Error occurred in the browser console when editing the date on the Single Entries Page.
- Single Line Text element map size was too small in the Form Builder preview.
- There was a fatal error on the Analytics page if the MonsterInsights Lite plugin was active.
- The Dropdown field inside the Layout field on mobile devices was partially overlapped.
- The "Preview Conversational Form" button overlapped with the title when a browser window was resized.
- Password strength notices did not have rounded borders as they should.
- The Address field sub-labels were positioned too close to dropdowns inside the Layout field.
- Form Location title and slug were incorrect after updating a post with that form embedded.
- The "From Email" option validation message was invisible when the WP Mail SMTP plugin was active.
- PHP warning 'Illegal string offset' appeared on some sites.
- Placeholder text in the Dynamic choices of the Dropdown field was not displayed when the field was duplicated.
- The "Let's Go!" button inside the Form Embed screen was disabled after the page title change.
- Bulk option labels were not inline in some languages.
- Some field titles were broken in Safari in the Twenty Twenty-One theme.

## [1.8.2.2] - 2023-06-28
### Added
- WPForms is now compatible with the WPForms Coupons addon.
- Developers can now use a new hook that is fired when the form is duplicated.

### Fixed
- Stripe Integration: JavaScript error occurred when the user was asked to enter verification information for a payment form locked with the Form Locker addon.
- A PHP deprecation notice was generated when enabling or disabling auto-updates of any plugin.
- Form challenge items were not aligned correctly in various languages.
- In Modern File Upload fields, long file names caused the upload progress bar to overlap with the file name.
- Legacy Layout Classes didn't work when using the Modern Form Styles.
- Custom Math Captcha was still large when the Lead Forms addon was disabled.
- Long links on the Entry details page did not wrap and caused overflow issues.
- Checkboxes and Multiple Choice fields with icons were cut on mobile devices.
- Words in the Form Export dropdown on the Tools > Export admin page were split by letters.
- Links were stripped in choices labels.
- Block Editor kept showing the unsaved changes dialog even though there weren't any changes.
- `wpforms_sanitize_amount()` function did not work properly with exponent numbers.
- Compatibility with the Popup Maker plugin was improved - Stripe Credit Card field didn't load when a payment form was inserted into a popup.
- There was no empty state when no forms created for the WPForms widget in the Elementor screen.

## [1.8.2.1] - 2023-06-07
### Changed
- On the Form Entries page the "Status" column is renamed to "Type" to better reflect the actual value displayed there.

### Fixed
- On the Form Entries page the "N/A" entry status was displayed instead of the expected value "Completed".
- On the Payments page for Stripe payments "N/A" was displayed as a payment title instead of the mapped email.
- There were situations when PHP notices were generated on the Stripe Single Payment page.
- Compatibility with the "AIOSEO - Local Business" plugin was improved.

## [1.8.2] - 2023-05-31
### Added
- Payment fields are now available for everyone.
- Users can connect their Stripe accounts and receive payments via their payment forms.
- It's now possible to print entries in bulk.
- Non-admin users are now notified about uninstalled or not activated addons when certain form templates are selected.
- New filters are added so it's possible to dynamically modify form data before export.
- There are new thumbnails displayed in all places where you see the list of available form templates (Form Builder and Form Templates page).
- Plugin cache files are handled in a more performant way.

### Changed
- The Entries Overview graph and table can now be filtered by custom timeline.
- An outdated version of the Moment.js library was removed from the plugin, and we switched to using the one bundled in WordPress.
- Preview labels for choices with HTML tags were improved.
- Empty dynamic choices in the Form Builder, on the front end, and the Entry Edit page are now more visually appealing.

### Fixed
- There were situations when the `{user_ip}` smart tag was returning a server IP address instead of the actual user's IP address.
- The Content field label was visible in the Conversational Forms mode.
- An unnecessary database query was run on all admin dashboard pages.
- The Modern Multiple Dropdown couldn't be closed by clicking on the arrow.
- The "Save" button wasn't fully clickable on the WPForms > Settings admin page.
- Some UI elements didn't look correctly on the Form Builder page for non-English languages.
- Some fields were non-responsive on mobile when using the Legacy Layout Classes.
- Cron event `wpforms_email_summaries_cron` was not removed upon plugin deactivation.
- Multiple Choice conditional logic wasn't operating reliably if the field value was empty.
- It was possible to add disabled fields to the form again in the Form Builder.
- The form was not displayed on the front end when the WPForms block was added to block templates.

## [1.8.1.3] - 2023-05-25
### Changed
- The Uncanny Automator logo is updated.

### Fixed
- Debug information (controlled by a constant) is now properly escaped before being displayed on a page.
- Turnstile Captcha verification message overlapped the captcha when the captcha type was changed from Invisible to Managed.
- Fatal error with AMP plugin.

## [1.8.1.2] - 2023-04-12
### Fixed
- Checkboxes were shifting when the limit choices rule was triggered.
- "Ask for a review" admin notice links improperly opened new tab.
- Empty checkboxes and radio fields were not hidden when printing entries.
- The Next button was not blocked when the File upload field triggered any error.
- The message design has been adjusted for a valid license notification after upgrading to Pro with an invalid/expired license.
- The "Unselected Choices" option worked incorrectly for Dynamic choices in the Entry Print functionality.
- Rich text field was generating an error in a browser console during form submission on WordPress 5.2.
- There was a fatal error when settings were incorrectly reset by a 3rd-party plugin.

## [1.8.1.1] - 2023-03-30
### Fixed
- Limit Length functionality was broken in the Paragraph Text field.

## [1.8.1] - 2023-03-28
### Added
- Modern Form Styles - easily control the appearance of form fields, labels, and buttons without writing code, right inside the Block Editor.
- The new filter `wpforms_frontend_assets_header_force_load` allows forcing load assets in the header which is useful when the form is in the sidebar widget and similar locations.
- The new filter `wpforms_entry_preview_get_start_page_break_id_force_first` allows showing all fields from the beginning of the form to the current entry preview page.

### Changed
- Tooltips design is improved.
- Entry Print Settings design is revised to provide better UX.

### Fixed
- The form preview page was incorrectly shown in some themes.
- CF turnstile form ID was translated creating problems with analysis in Cloudflare Dashboard.
- Country list style was adjusted for the Phone field, specifically on dark themes.
- Notifications Settings styles were looking bad on a small screen in the Form Builder.
- An "active column" state was stuck for a duplicated Layout field inside the Form Builder preview panel.

## [1.8.0.2] - 2023-02-28
### Changed
- Updated DOMPurify library to 3.0.1.

### Fixed
- An error occurred when the DreamHost Panel Login plugin and WPForms Lite were both active and WPForms Pro was activated.
- Some dropdown fields in the Marketing settings area of the Form Builder were rendered incorrectly in Safari after making a selection.
- Form template block in the Form Builder could overflow the container on smaller screen sizes.
- Long links in the HTML email messages did not wrap and caused overflow issues.
- Google reCAPTCHA v2 could not be reset on server-side validation failure.

## [1.8.0.1] - 2023-02-15
### Fixed
- Invisible reCaptcha was incorrectly processed resulting in failed form submissions with a wrong error message.

## [1.8.0] - 2023-02-14
### Added
- Prevent spam submissions using the new Cloudflare Turnstile anti-spam integration. You can find it on the Settings > CAPTCHA page.

### Changed
- Custom Captcha and Section Divider fields are now excluded from custom fields mapping in marketing addons.
- Filter by country and filter by keyword error messages are now displayed above the Submit button.
- Non-public taxonomies should not be displayed in Dynamic Choices' available sources.
- The "Resend Notifications" link on the Entry page is disabled instead of being hidden if any addon blocks this functionality.
- External usage of removed PHP classes is now handled gracefully without generating fatal errors.
- Redundant Transaction IDs are not displayed for recurring subscription payments in the View Entry > Payment section.
- The performance of the Email field validation is improved when using an allowlist or denylist.
- Files uploaded through Modern File Upload and Rich Text fields to the Media Library now have attachment titles in the "Field label: Original file name" format.
- State and Country subfields of the Address field now allow selecting the default value from the dropdown if it contains choices.
- State and Country subfields of the Address field now allow unsetting the default value.
- Updated DOMPurify library to 2.4.3.

### Fixed
- The Dropdown field text indentation was incorrect in the Form Builder in Firefox.
- Various notification modals' titles had inconsistent sizes in the Form Builder.
- Users without permission to view Entries should not see links for entry counts in the Dashboard widget.
- The header column background did not fill the entire column height in the Compact view of the Entry print preview.
- Validation errors in various modals were inconsistent in the Form Builder.
- When duplicating an inactive field, the settings of the active field are now removed properly.
- Malformed HTML in the Entry Preview Notice field could brake the Form Builder markup.
- It was impossible to remove an expired license key after upgrading to WPForms Pro if it was initially set in WPForms Lite.
- The expired, disabled and invalid license notices were shown twice after entering the key in the WPForms Lite, then installing and activating WPForms Pro.
- The Page Break field was inserted in the incorrect position if the form contained a notice about a certain field being not available under the current license.
- Some cache files were unnecessarily re-downloaded on the front end.
- The Single Item field with a User Defined type could be submitted with a negative amount.
- Prevent other plugins from adding custom buttons to the Content Field TinyMCE editor to prevent functionality breakage.
- Images in the Rich Text field were ignoring alignment settings in the entry notification email.
- Users with roles other than Administrator could not add the reCAPTCHA/hCaptcha field and dismiss notices even if they had sufficient permissions.
- Number Slider field validation failed if a maximum value was not a multiple of steps.
- Buttons inside of notices inside of 4-column layout fields were formatted incorrectly.
- Max File Uploads could have been set to 0 or an empty value, causing File Upload field validation to fail.
- The Previous page of the Page Break field could not be opened without filling in the Credit Card Number field.
- Entries export was not working on non-direct file systems, e.g. SSH2, FTP, etc. (including Pantheon.io using Git).
- Image Choices in Multiple Choice fields were not displaying the image in the entry preview when the choice label contained HTML.
- HTML markup in the Default Text of Paragraph Text fields was not being displayed on the front end and in the Form Builder preview.
- Placeholders and Default values of various subfields of the Address field are now consistent in the Form Builder preview.
- Admin bar icons were broken after submitting a form with the Rich Text field.

## [1.7.9.1] - 2023-01-11
### Fixed
- Layout fields were not shown when they were on any page other than the first page of a multi-page form and conditional logic was enabled on at least one field within the Layout field.
- Incorrect spacing around the Submit button in the Form Builder was fixed.
- Missing assets were added to the plugin.

## [1.7.9] - 2023-01-03
### Added
- Icon Choices feature for Checkboxes, Multiple Choice, Checkbox Items, and Multiple Items payment fields - a selection of 2000+ icons can now be used with your choices!

### Changed
- Avoid rendering the WPForms Import admin page if the user lacks `unfiltered_html` capability.
- Respect site settings for displaying avatars on the Revisions screen in the Form Builder.
- Minor CSS adjustments on the Entry details page.
- Color picker fields in the Form Builder are now correctly handling default colors.
- In the form Notifications you can now set up the Reply-To Name value in addition to the Reply-To Email using a special format.
- Updated jquery-confirm library to 3.3.4.

### Fixed
- Improved a preview for the Classic File Upload field in the Form Builder.
- Prevent field duplication in the Form Builder performed multiple times when clicking fast inside the confirmation modal.
- Action links were rendered on two lines in the admin dashboard widget.
- The content editor option in HTML mode was not visible when the Content field was added inside the Layout field.
- Buttons of the content editor option in Visual mode didn't have hotkey texts in their tooltips when the Content field was added.
- Email notification was not able to show the submitted Content field value.
- Text and image styles were not applied to the Content field value on the Entry Print Preview page.
- WordPress VIP platform users were unable to export form entries.
- Styles for the Content field editor were not applied when the field had been placed in the Layout field in Firefox.
- The content field disappeared if it was duplicated inside the Layout field.
- A blank space was showing when all of the fields inside of a Layout field were hidden using the Conditional Logic.
- PHP notices were generated when form locations logic ran for unregistered post types.
- Not all WPForms-specific data was removed from the database when the Settings > Misc > Uninstall option was enabled.
- The Embed modal performance in the Form Builder was improved a lot when there are a ton of pages on a site.
- The confirmation message for non-AJAX form submissions wasn't wrapped into the main form container.
- In the Layout field its last column on the right side was always wider than other columns.
- Improved compatibility with Elementor popups v3.9+.
- Notification email suggestion didn't work properly in WordPress installed in a subdomain.
- License key was incorrectly processed when set in the `wp-config.php`.
- `{page_title}` smart tag was conflicting with the wpSEO plugin.
- Better compatibility with the Popup Maker plugin.
- Activate the first form page with an error after failed form submission for AJAX forms.

## [1.7.8] - 2022-11-09
### Added
- Introducing a completely new Content field to help you easily add formatted text to your forms.
- Submitted files can now be attached to the notification email, that is configurable on the Form Builder > Notifications screen.
- All anti-spam protection settings are grouped in one place in the Form Builder > Settings for easier access.
- You can now completely block form submissions from certain countries.
- You can also block form submissions that contain particular keywords.
- New hooks at the beginning and end of each page of the Page Break field.

### Changed
- Recently added Form Templates are now available in the "New Templates" category.
- Non-responsive (desktop) version of the Form Builder is not accessible on mobile devices.

### Fixed
- jQuery deprecation notices were triggered in the browser's console.
- Close button in dropdowns was displayed incorrectly in certain places.
- A PHP warning was raised on certain site configurations when the user tried to submit a form.
- Toggle control animation was working incorrectly in certain cases.
- Required fields were still highlighted as incomplete after being filled on the Form Builder > Marketing screen.
- Text was overlapping the down arrow on dropdowns in the 2021 theme.
- The Currency field dropdown went outside of the page border in the Form Builder.
- WPForms Challenge user experience was improved.
- Smart tag list was too big in fields with warnings.
- Some input masks caused the text in the Text field to be right-aligned.
- Compatibility with the 2023 theme was improved.
- Search was incorrectly processing the `0` term when performed on the Entries Overview page.
- Entry Preview functionality didn't work on the Form Preview page when Conversational Forms was enabled.
- A PHP warning related to the Entry CSV Attachment was raised when navigating through different form revisions.
- Entry CSV Attachment settings were not saved properly when saved too quickly after the page load.

## [1.7.7.2] - 2022-10-12
### Added
- There is a new filter `wpforms_builder_panel_sidebar_section_classes` to change builder panel sidebar section classes.

### Changed
- Updated DOMPurify library to 2.4.0.

### Fixed
- Placeholder text in the Dropdown field was cut off in the Form Builder.
- The Form Builder had an inconsistent text strings escaping.
- The information about "no form templates to display" did not disappear when a category was changed.

## [1.7.7.1] - 2022-10-05
### Fixed
- Email Notifications options for completed payments were displayed in an incorrect place - below the Settings > Notifications > Advanced section in the Form Builder.
- Very long field labels were not wrapped and were breaking mid-word.

## [1.7.7] - 2022-09-27
### Added
- Introducing a completely new Layout field to help you build advanced form layouts that automatically adjust to the users’ screen size.
- All templates are now available on our new Form Templates admin page.
- Form Templates can now be marked as favorite for easier access to forms inside the Form Builder.
- The form fields column can now be collapsed in the Form Builder to give more space to the form preview panel.
- Form submission values can now be attached as a CSV file to the notification email. You can set it up on the Form Builder > Notifications screen.

### Changed
- The DB tables row in the Site Health Info section is now private which means it's excluded from the copied data when the "Copy site info to clipboard" button is clicked.

### Fixed
- Selected columns were not centered in the Entries Field Columns dropdown.
- WPForms Challenge was displayed after a forms search with no result.
- WPForms Challenge disappeared after selecting a template for the new form.
- After a form submission a PHP warning was generated in some cases when the Akismet anti-spam protection setting was enabled.
- Using allow/deny list was breaking input mask validation for all fields above the Email field.
- An unusually long text string in the confirmation message caused layout problems due to overflow.
- File upload field was broken in the Block Editor on WordPress 5.2-5.4.
- The time value for the Date/Time field was not populated correctly on the Edit Entry page.
- `page_title` smart tag was working inconsistently on a form preview page.
- `wpforms()->get( 'entry' )->get_entries()` returned all entries when no entries were found.
- From Email address check in the Form Builder > Notifications was incorrectly handling domain check containing the `www` prefix.
- It was possible to execute exported field values as formulas in `.csv` and `.xlsx` files.
- Input mask validation message didn't use what was previously saved on the WPForms > Settings > Validation page.
- On the Form builder, a template selection didn't work if a page was translated through web extensions.

## [1.7.6] - 2022-08-16
### Added
- Entries can now be checked against the Akismet API to prevent spam submissions.
- When exporting entries on the Tools > Export page all items can be selected or deselected easily with a single click in Form Fields and Additional Information sections.

### Changed
- Only 3 uploaded files are now displayed in the table on the Entries list page.
- Paragraph and multiline long values are properly truncated to improve readability on the Entries list page.
- Display fields available according to license level as active in the Form Builder, even if the required addon is not installed or activated.
- Single Item field placeholder option is now displayed only when a User Defined type is selected.
- The Date/Time field displays options from `01` to `12` instead of from `00` to `11` when the format is set to `12 H`.
- Address field' country name is now displayed instead of the country code throughout the plugin admin area.
- Empty post titles and term names in Dynamic Choices are now treated the way WordPress does.
- Modern Dropdown field fuzzy search sensitivity is adjusted to display only exact matches.
- Allow typing choices in the modern Dropdown field with the Multiple Options Selection option enabled.
- WPForms Challenge experience is improved for new users.
- Lite Connect is now disabled in non-production environments.
- Lite Connect functionality improves handling of staging and cloned sites, and changed domain names.
- Unnecessary PHP packages are no longer shipped in WPForms Lite.
- Stylesheets loaded in the Form Builder and on certain plugin pages are better optimized and shrank to improve performance.
- WPForms now better integrates with the WP Mail SMTP plugin to enable overriding From Name and From Email values in existing forms.
- Form Notifications now have better validation of From Email settings.
- Displaying and counting the total number of entries is improved across the admin area of the plugin.
- Start using new `elementor/widgets/register` hook introduced in Elementor 3.5.0.
- The intl-tel-input library has been updated to v17.0.17 to support more regions and area codes.
- Updated DOMPurify library to 2.3.10.
- Updated jquery.validate library to 1.19.5.

### Fixed
- Improved compatibility with Twenty Twenty-Two theme.
- No more missing form ID in the date dropdown `id` HTML attribute.
- Added meaningful `alt` text to form submission spinner image to stop being flagged by certain SEO scanners.
- Address field's Country value on the Entries list page was truncated with the International scheme set.
- Lite Connect import admin notice on the Tools > Scheduled Actions page was positioned incorrectly.
- Page break titles overlapped on certain screen sizes when using the Connector progress indicator.
- Single Item field Placeholder value was not updating correctly in the Form Builder preview.
- Constant Contact Authorization Code and Account Nickname fields are now required on the Settings > Integrations page.
- Constant Contact connection can now be added even if the Authorization Code is invalid.
- Error occurred upon form submission when Time in Date/Time field was set to 00AM.
- Fields that required unique answers did not work with page breaks.
- A form with a smart Phone field that requires a unique value didn't get submitted if the phone field value was invalid, even if the phone field was hidden by conditional logic.
- Form cannot be submitted now until all uploads in separate modern File Upload fields are finished.
- Conditional Logic was not working when the value was updated on paste from the clipboard.
- Modern File Upload field was not fully cleared when hidden and shown again with Conditional Logic applied.
- Validation of required fields on Marketing or Payment sections in the Form Builder was triggered even if the field is hidden.
- Action Scheduler was triggering a PHP fatal error on the Tools > Scheduled Actions page on PHP 5.6.
- Images breaking out of containers on smaller screens if Multiple Choice and Checkboxes fields were set to use image choices.
- `query_var` smart tag was not working in Confirmations and Notifications.
- Incorrect results were displayed when search by term was combined with a date filter.
- Plugin and addons could not be updated via WP CLI.
- Custom templates had an incorrect badge, "Addon" instead of "Custom".
- The Confirmation Message label overlapped the editor when WYSIWYG mode was disabled.
- A list of IP addresses forwarded by Cloudflare or some other proxies could not be parsed if it contained spaces.
- Default form title was not changed when switching form templates.
- Both `page_title` and `page_id` smart tags were returning incorrect values on non-singular pages if the form was used outside the Loop.
- WPForms Block preview (on block hover) was rendered incorrectly in Site Editor.
- Users with roles other than Administrator could not see all export options even if they had sufficient permissions.
- Display only those sections that the user has permissions to view and interact with on the WPForms > Tools page.
- Rich Text field label was misplaced if positioned below the Single Line Text field with the Address Autocomplete option enabled.
- Sorting entries by Total column worked incorrectly when combined with pagination.
- User-uploaded files remained in the /uploads/wpforms/ directory when an Entry was deleted.
- Partially uploaded user files were not deleted when the upload was interrupted or canceled.
- Files with extensions containing an underscore or a hyphen were not supported by the File Upload field.
- Custom validation errors were not displayed with hCaptcha enabled upon AJAX form submission.
- Validation errors were not shown when the field with an input mask was not fully filled.
- Duplicated entries were created in the database when an entry of the form with more than 30 fields was edited.
- Smart Tags could be added to Sender Email and Sender Name if the fields were managed by the WP Mail SMTP plugin.
- The Confirmation message block had incorrect margins in the Twenty Twenty-Two theme.
- Occasional errors during migration were fixed when upgrading from some older versions of WPForms.
- The Confirmation Redirect URL can no longer be saved with an empty value.
- Default choices were displayed on the frontend if a Dynamic Choices source had no objects (Dropdown, Multiple Choice, and Checkboxes fields were affected).

## [1.7.5.5] - 2022-07-28
### Fixed
- Migrations logic was broken in certain cases when addons have their own migrations.
- Security-related improvements around email generation for notifications.

## [1.7.5.4] - 2022-07-22
### Fixed
- Some users were not able to use templates when creating a form.

## [1.7.5.3] - 2022-07-19
### Added
- New filter to modify CSS classes of the form submit button on the frontend.

### Changed
- The PayPal Standard transaction URL now uses a new format on the Entry details page.
- Improve cached templates handling in the Form Builder.

### Fixed
- Retrieving a current URL should not strip a custom port.
- "JavaScript file not found" error when the "Load Assets Globally" option was enabled in Settings > General.
- WordPress database error when upgrading from WPForms Lite to WPForms Pro.
- Do not cache an incorrect or empty response from the Templates API.
- PHP warning raised in certain notifications configuration when PayPal payment status is changed to Completed.

## [1.7.5.2] - 2022-07-15
### Fixed
- Increase chances for the templates inside the Form Builder to load properly, so occasional empty form creation from a template should be gone.
- PHP fatal error was generated in some cases when Lite Connect attempted to generate site key too many times.

## [1.7.5.1] - 2022-06-30
### Fixed
- v1.7.5 migration did not complete when a database prefix other than `wp_` was used.
- Form Tags: incorrect links to filter by tags were generated right after saving tags.

## [1.7.5] - 2022-06-28
### Added
- Form Tags: add tags to forms with an ability to filter by them; bulk add/edit/delete tags for multiple forms.
- Payment details stored in entries are now searchable.
- Display the status of the Lite Connect setting and the date-time when it was enabled (Tools > System Info).
- New `{unique_value}` smart tag.

### Changed
- The sodium library is now included in WordPress core, so we removed it from the plugin.
- Action Scheduler library was updated to 3.4.2 to fix deprecation notices with PHP 8.1.
- The jquery.validate library updated to 1.19.4.
- Conditional logic can now be applied to custom fields.
- Do not allow not completed Challenge to appear in the regular Form Builder.

### Fixed
- For some fields, their default values were not always previewed in the Form Builder.
- Regularly clean up additional information we store for each task we run within the plugin.
- No fatal error anymore in Allow/Deny email lists with very long or international emails.
- Correctly handle additional CSS classes for each WPForms block on the same page (Block Editor).
- Properly process survey field values when they were updated to become empty.
- Modals order was incorrect when the Lite Connect feature was enabled or disabled on mobile.
- Notification for the last step of the WPForms Challenge was not displayed on the Posts Page with the Gutenberg plugin.
- Some Form Templates could be empty upon fresh installation.
- Several minor issues in the Challenge flow are now fixed.
- Total value for items with a cost lower than 1 dollar was calculated incorrectly.
- Color Palette was not shown in the Form Builder for duplicated fields.
- Do not register Gutenberg block styles on the front end when no form is present on a page.
- Access Controls: Entries list showed all forms with the 'View Others Forms' capability.
- Form Builder exited automatically when a user with allowed permissions created a form.
- Limit the number of attempts to get the site key in Lite Connect.
- Multiple Items (Radio) choice showed "Empty" on a single entry page if a selected choice value is undefined/empty.
- Search results didn't show old abandoned and partial entries after the latest addon update.
- Entries Search on the Entries Table page was not fully cleared when a user cleared the search.
- Several issues were fixed with the ability to move certain fields (Page Break and Entry Preview).
- Elementor popup was not processing conditional logic on the initial load.
- Added focus state indication for admin tabs.
- Duplicated column name appeared in the columns configs on the Entries Table page when a user tried to change settings.
- Edit Entry: the Date field with a custom format was shown improperly.
- GDPR sub-settings remained enabled if GDPR is disabled and sub-setting was left enabled.
- Duplicate/Trash form actions did not work after sorting forms by Name, Author, or Created Date.
- Improved styling of the warning/loading message for the Modern File Upload field.
- Notices appeared in the debug.log when the user created a Custom Template and used it in the Form Builder.
- Entries Overview: search attributes were removed when searching for an empty HTML tag.
- Empty license was shown improperly in some cases inside the Site Health.
- Fatal error on PHP 8 after a PayPal payment.
- hCaptcha pointer had a weird thick dark border since WordPress 6.0.
- Check GDPR settings before trying to use a cookie.

## [1.7.4.2] - 2022-05-19
### Changed
- DOMPurify library updated to 2.3.8.

### Fixed
- PHP notices avoided in Lite Connect if decrypted entry data didn't contain required keys.
- Lite Connect: submitted form entries counting and import-complete notice improved.
- WordPress 6.0 compatibility: WPForms block styling fixed inside the Full Site Editor.

## [1.7.4.1] - 2022-05-05
### Fixed
- LiteConnect auth key request didn't work with plain permalinks and with subdirectory install.
- Do not display the import entries notice if the license key is not valid.
- Improved Form Locations compatibility with the Full Site Editor template parts.

## [1.7.4] - 2022-04-26
### Added
- Form Locations! On the Forms Overview page easily check all places where each form is currently embedded.
- Back up form submissions into the cloud and restore them to your database as Entries after upgrading to a paid plan.
- New `{entry_details_url}` smart tag.

### Changed
- Improved text wrapping of field labels and descriptions.
- Each smart tag inserted by a user in the Form Builder will now be placed as the last one in relevant inputs.
- Show error message during Entry Export if some error occurs.
- Admin dashboard widget can now change the color scheme and graph style.
- The input field in the Form Embed wizard popup in the Form Builder is now focused by default.
- Updated DOMPurify lib to 2.3.6.

### Fixed
- Adding Entry Preview field after visiting the Revisions panel.
- Search result was not reset when the user clicked "x" sign in the search field on the Addons page.
- Strength validation was failing when the Password field was empty and not required.
- Entry Preview field didn't show fields with an input value of `0`.
- Some fields' `0` value was shown as empty on Edit Entry and Print pages.
- Form's Entries page unread/read and starred/unstarred notices were behaving incorrectly.
- Entry values weren't exported (.xlsx) if form fields had the same label.
- Entry export didn't work for non-admins with 'View Entries' access.
- Error occurred when the user clicked on the Export Entries download link.
- Configurations on the Payments tab in the Form Builder were not previewed when a user was previewing form revisions.
- Dynamic choices were not prefilling values for the Multiple Choice field on the Edit Entry page.
- Plugin data should not be deleted when Lite was deleted, and Pro is still active.
- The form could be saved while still adding a field, but it should not.
- Improved compatibility with Elementor popups.
- Cleaned up deprecation notice for `_register_controls()` with recent Elementor versions.

## [1.7.3] - 2022-03-16
### IMPORTANT
- Support for PHP 5.5 has been discontinued. If you are running PHP 5.5, you MUST upgrade PHP before installing WPForms 1.7.3. Failure to do that will disable WPForms core functionality.
- Support for WordPress 5.1 has been discontinued. If you are running WordPress 5.1, you MUST upgrade WordPress before installing WPForms 1.7.3. Failure to do that will disable WPForms core functionality.

### Added
- Forms now can be moved to Trash and restored on the Forms Overview page.
- Forms now support Revisions with new UI and ability to switch between them.
- Exported entries (.csv and .xlsx) now have an Entry Status column that indicates completed, abandoned, or partial entry.
- Export Entries and Form Template Export selection on the Tools > Export page now support search.

### Changed
- Improved support for WordPress Core UI colors and admin themes in the admin notifications panel.
- Improved submitted email field value validation (take into account real-world usage and RFC information).
- Improved `wpforms_get_ip()` IP detection quality by taking care of proxies (e.g. when the site is behind Cloudflare).
- Improved Time selector display with a limited number of choices.
- Updated Action Scheduler library to 3.4.0.
- Improved the manual addon installation message if automatic installation fails, added links to the downloads page and a manual installation guide.
- Hide Sub-Labels option should be hidden for some formats in the Name and Date / Time fields.
- Improved performance of Action Scheduler tasks.
- Drop jQuery matchHeight library in favor of a CSS solution.
- Abandoned and partial entries are now displayed in search results on the Entries page.
- Unified and improved modals across all plugin pages and the Form Builder.
- Forms now can be deleted when the user who created them is deleted.

### Fixed
- Confusing alignment of Print Preview options on small screens.
- Long field titles didn't wrap within the field container.
- Stuck on loading the Form Builder when switching to a new form template with unsaved changes and dismissing the native browser prompt.
- Buttons had no spacing when the Embed button is not available for a user without the capability to edit pages and/or posts.
- Fly-out menu was not auto-hiding on the Entries page with Survey Results enabled.
- Incorrect position of the notification counter in the admin bar when a notification was dismissed.
- Misaligned buttons in the Entries navigation block on the single Entry admin page.
- Make the form Submit button disabled all the time after the submit action when AJAX form submission or confirmation redirect are enabled.
- Toggle control labels did not have a hand cursor.
- The `iframe` element in the HTML field was not displaying after meeting a conditional logic in the Twenty Twenty theme.
- The dropdown list was shown partially when located at the end of the form in the Twenty Twenty theme.
- Country flag from the Phone field was overlapped in the Enfold theme.
- Multiple selected options in the Classic Dropdown field didn't have a visual active state.
- CSV export filesystem issue on WordPress VIP platform.
- Deprecation notice when processing smart tags.
- False JavaScript issue error when WP Rocket's Delay JavaScript execution option is on.
- PHP notice generated when email notifications were sent.
- "Did You Know" block now always spaned across all columns.
- Validation error if an email was not required and left empty.
- Email field validation failed with long and invalid emails.
- Import from other plugins.
- Compatibility with PHP 8.1.

## [1.7.2.2] - 2022-02-03
### Fixed
- Compatibility with current versions of the User Journey and Form Locker addons.

## [1.7.2.1] - 2022-02-03
### Fixed
- Compatibility with PHP 8.0 and PHP 8.1.
- Compatibility with WordPress 5.9, including its new Full Site Editing feature.
- Broken cache directory path if `WP_CONTENT_DIR` is set in the `wp-config.php` without trailing slash.
- PHP Notice when using the `wpforms_log()` function in certain conditions.
- Type mismatch breaks a list of scheduled actions in Action Scheduler if typed arguments are passed.

## [1.7.2] - 2022-01-04
### Added
- Search by form name and description is available on the Forms Overview page.
- New "Author" column in the Forms Overview table to display a name of a person who created the form.
- Display log records on the single Entry page when an entry note has been added or deleted.

### Changed
- Adjusted an error message for the Locked Field modal when attempting to delete required form fields.
- Hide image choice style options if image choices are not enabled.
- Improved sanitization for Page and Form IDs in Form embed wizard popup.
- Adjusted Weekly Summary email text for Lite users.
- Updated the WPForms > About Us page.
- Updated jQuery inputmask lib to 5.0.7-beta29.
- Updated DOMPurify lib to 2.3.4.

### Fixed
- Missing search docs in the Form Builder Help.
- Display empty table instead of empty state screen for Unread (0), Starred (0), Abandoned (0), etc., views.
- Input mask prevents fields with conditional logic from being displayed on paste.
- Classic file uploader: error message about the maximum allowed number of files wasn't displayed in a correct field.
- Media modal 'Actions' menu was missing when using the Divi Builder.
- PHP notice was generated on a form preview if a page template is changed.
- Correctly handle the legacy widget options (show/hide form title and description) on the front-end.
- Do not generate PHP notices in debug mode when Address field inputs were removed using filters.
- If a form with configured Google reCAPTCHA v3 is submitted after 2 minutes, there was an error "Google reCAPTCHA verification failed, please try again later."
- Better compatibility for From Name and From Email fields in the Form Builder > Notifications screen when the WP Mail SMTP plugin forces those values.
- `{field_id="#"}` smart tag stripped out HTML encoding in the URL that is saved in the URL field.
- PHP warning occurred when the `%` symbol is used inside some Form Builder settings.
- Form Preview didn't work properly on the upcoming Twenty Twenty-Two theme.
- PHP timeout occurred in the Form Builder when large multi-level term taxonomies were used as dynamic choices for Checkboxes/Multiple Choices/Dropdown fields.
- PHP notice generated on the Entry Print Preview page if a form was changed.
- PHP fatal error generated in some cases when Site Health information was displayed.
- WP.com VIP clients used to have caching issues with external data.
- WooCommerce product import (CSV) to update existing products wasn't updating product images while WPForms was active.
- Form couldn't be submitted on the Lite version of the plugin when it contained the Page Break field from the paid version.

## [1.7.1.2] - 2021-11-18
### Fixed
- Uploads via Modern File Upload field fail if `ext-fileinfo` PHP extension is disabled.
- File Upload field not storing the upload with Conditional Logic configured in certain ways.
- Edge case when form tokens (anti-spam protection) failed verification at certain time of a new day.

## [1.7.1.1] - 2021-11-11
### Fixed
- Email address validation against allowlist or denylist always fails.
- Country flag from Phone field position on top of Dropdown field choices on Edit Entry page.
- Legacy Stripe field not showing years in credit card expiration subfield.

## [1.7.1] - 2021-11-09
### Added
- Time values are now validated against Limit Hours settings of the Date / Time field.

### Changed
- Updated bundled Dropzone.js library to 5.9.3.
- Improved translations by removing confusion if non-translatable placeholders are used.
- Improved support for WordPress Core UI colors and admin themes in admin bar menu.
- Improved format and limits validation of modern File Upload field.
- Improved display of empty and hidden field labels in Form Builder preview.
- Field helper notification in the Form Builder now can be dismissed.
- Improved and standardized look of classic and modern Dropdown field across Form Builder, admin area and frontend.
- Display "Save and Resume" link in Page Break field preview in Form Builder if Save and Resume is turned on.

### Fixed
- Empty fields are displayed on Entry details after editing an Entry with Page Break or Entry Preview fields.
- Strip slashes from Paragraph Text field when the value is dynamically populated.
- SMTP settings page linked to Setup Wizard even when SMTP settings are already configured.
- Occasional fatal error when moving Page Break field while another field is being added on slow Internet connections.
- Entry Print Preview displays empty admin page if Entry ID is not valid.
- File upload error when custom validation of any other field fails.
- Notifications count in the admin bar is misaligned.
- Field helper notification in the Form Builder overlaps and blocks Duplicate and Delete actions when hovered.
- Inconsistent new lines in different field types in Entry Preview.
- Non-latin (Punycode) email addresses are not converted for display in email suggestion hints.

## [1.7.0] - 2021-10-05
### Added
- New field - Rich Text.
- Uncanny Automator integration.
- New filters to programmatically hide certain field values from the Entry Preview output.

### Changed
- The "Back to All Entries" link is replaced on the "Back to Entry" on the Edit Entry page.
- Improved form builder education: install and activate payment addons without leaving the form builder.
- Updated jQuery Validation library to v1.9.3.

### Fixed
- Incorrect handling of language files downloads when the plugin is activated, or site language is changed.
- Page Break: disabling the Previous button does not work.
- Alignment for admin notification counter.
- Keyboard does not focus on a numeric keyboard on mobile devices with the US-format Phone field.
- Placeholder styling issue in Modern Multiple Dropdown field that is Conditionally Shown.
- Ability to delete uploaded files on the Edit Entry page.
- Javascript error in Elementor page builder.
- Embedded forms into global sidebar report about an error in the Divi page builder.
- Change settings were not applied for a Duplicated Modern Dropdown field.
- Do not allow Entry editing when a form template is changed on the Blank Form.
- PHP fatal error generated on some installs when spawning cron as an unauthenticated user.
- Form fields not displaying full width on mobile devices with Base form styling selected.

## [1.6.9] - 2021-08-24
### Added
- New field - Entry Preview.
- Keyboard Shortcuts informational popup in the Form Builder, triggered with `Ctrl + /` shortcut.
- Separate category for templates added by addons.
- Smart Tags support in Confirmation Messages.
- Advanced Entry search by Entry ID, Entry notes, user IP, and user agent.
- Punycode support for the Email field to allow using international domain names.
- Compatibility with PHP 8.

### Changed
- Display only WPForms related actions on the Tools > Scheduled Actions page.
- Enable AJAX form submission by default for new forms created using Blank template and addon templates.
- Default state on the CAPTCHA Settings screen on new installs is now set to None.
- Improved consistency of various modal popups in the Form Builder.
- Do not allow Entry editing when there are no fields with editable values.
- Speed up form preview in the Form Builder by limiting the number of choices displayed.
- Updated ActionScheduler library to 3.2.1.
- Updated Flatpickr JS library to v4.6.9.

### Fixed
- Tooltip is not working for the Form Locker Message box options.
- Avoid error by allowing objects implementing the `__invoke()` method as a hook callback.
- Missing down arrow in the Dropdown field in the Twenty Twenty-One theme on a fresh install.
- Clicking on the Field Options tab in the Form Builder always opens options for the first field in the form.
- Form Setting panels can be broken by horizontally resizing textarea fields.
- Unable to remove or duplicate the Section Divider field with an empty label.
- Insert/edit link button not working in the Confirmation Message editor.
- Prevent editor styles from loading on various settings pages.
- Missing Conditional Logic class in the Lite version causing errors when using custom integration that extends the `WPForms_Provider` class.
- Console error in Chrome when re-ordering choices in the Dropdown, Checkboxes and Multiple Choice field settings.
- Unrelated admin notices are no longer displayed on the WPForms admin pages.
- Modern Dropdown and Custom Captcha fields not initialized properly in the Divi Builder.
- Dropdown preview in the Form Builder not updated if the first option's value is empty.
- Password strength meter generating JavaScript error in WordPress <5.5.
- Preserve reply-to in the Notifications settings when creating a form from a template.
- CSS improvements of View and Edit Entry pages when there are no fields.
- The Address field in the International format now renders correctly when subfields are turned off.
- Translations are not fully loaded when changing the site language.
- Minor button styling issue in WordPress 4.9.
- Various Dropdown field CSS issues in the Form Builder.
- Misaligned icon in the Dashboard widget.

## [1.6.8.1] - 2021-07-21
### Changed
- Allow using right-click to open a form preview in a new tab or window.

### Fixed
- Notifications disabled on the previous version were enabled after the 1.6.8 update.
- Single Item field set to Hidden type now does not have unnecessary padding.
- Block preview in new WordPress 5.8 Widgets Block Editor now aligned properly.
- Omit a redundant number of files option from the Classic File Upload field.
- Some fields had no padding on the Edit Entry screen if the value was empty.
- Word wrapping issues in various places for non-English languages.
- Remove excessive whitespaces after in the Notification name after cloning.
- HTML field in notification emails is now displayed honoring the field's conditional logic.

## [1.6.8] - 2021-07-13
### Added
- Form Builder visual modernization and improved user experience.
- Form Builder is now more optimized, loading and performing faster.
- More tooltips in various areas of the Form Builder to provide context for different options.
- A lot more Templates that you can use for one-click forms creation.
- Categorize Form Templates into different sections and improve search, allowing faster access and better user experience.
- New Preview button for all Templates, so you can check how your form will look like before applying the Template.

### Changed
- Dropped support for IE11 in the Form Builder (same as WordPress 5.8).
- Introducing tabs instead of accordion for Field Options in the Form Builder: General, Advanced, Smart Logic.
- Allow underscore symbol usage in Allowlist/Denylist in Email field.
- Updated DOMPurify lib to 2.3.0.

### Fixed
- A lot of visual inconsistencies inside the Form Builder.
- TinyMCE editor in the default Confirmation has 2 tabs (Visual, Text), which previously had incorrect height.
- Firefox-specific issue that prevents fields from being drag-n-dropped inside the Preview area of the Form Builder.
- Smart phone field flag appeared over modern dropdown field's choices.
- Heartbeat notification on the Entries page about new entry displayed incorrectly.
- Correctly change the HTML field label when the field is copied.
- Form Builder performance issue with large number of choices added to option fields.
- Missing down arrow in Dropdown field in Twenty Twenty-One theme.
- Checkboxes and Multiple Choice input fields rendered incorrectly in Twenty Twenty-One theme.
- Breaking words when wrapping in Modern Dropdown field.
- After upgrading the license, "Upgrade to Pro" popup is still displayed.
- Download all relevant translations when initiating an upgrade from Lite to Pro on the plugin Settings page.
- When deleting the last Conditional Logic rule, the fields are now reset.
- Preserve line breaks when pasting blocks of text into Paragraph field with word limit option enabled.

## [1.6.7.3] - 2021-07-02
### Changed
- Renamed a misspelled `wpforms_display_sumbit_spinner_src` filter to `wpforms_display_submit_spinner_src`, old name is now deprecated.

### Fixed
- Expired transients are not deleted automatically.
- Entries count race condition under high load in the plugin Lite version.
- Form Builder product education links.

## [1.6.7.2] - 2021-06-25
### Fixed
- Admin notice option flag reference.

## [1.6.7.1] - 2021-06-15
### Changed
- Password strength text in the Form Builder matches the text on a frontend now.
- Improved logic of pasting a text in the fields with word and character limits.
- Updated DOMPurify lib to 2.2.9.
- Some admin notices can be dismissed on a per-user basis.

### Fixed
- Smart Tags don't parse dot and comma symbols well.
- Occasional PHP Notices on getting addons' download URLs and printing the entry.
- In rare cases, WPForms functions calls are not handled correctly inside the third-party frontend AJAX calls.
- Tooltipster JS error on Edit Entry page.
- Incorrect `wpforms_smart_tag_process` filter deprecation notice.
- Compatibility with the Elementor 3.1.x, 3.2.x and 3.3.x.
- Broken XLSX of exported entries in rare cases when server temporary directory is not writable.
- Cleanup database from obsolete data after preparing an entries export file for download.
- Properly handle errors reporting when entries exporting failed for some reason.

## [1.6.7] - 2021-05-11
### Added
- Additional Print Entry screen controls for adding HTML fields and Section dividers into the printed page.
- Minimum password strength validation for a Password field.

### Changed
- Rephrased an error message for the Modern Upload field when the file wasn't uploaded.
- Email Summaries can now be tweaked via the hook to have multiple "To" recipients.
- Rewrote inline captcha scripts in vanilla JS to improve its compatibility with a third-party code.
- Replaced jQuery.isFunction() (deprecated as of jQuery 3.3) usages with a recommended counterpart.
- Email Summaries subject line is changed to reduce the chance of going into the spam folder.
- Refine smart tags system to improve extensibility.
- Warn users about deleting the field in a Form Builder containing conditional logic that affects other fields.
- Updated DOMPurify lib to 2.2.8.
- Each addon title is linked to related documentation on the Addons page.
- Externally disabled fields are displayed inside the Form Builder as dismissible notices.

### Fixed
- Inconsistency in "Add new group" conditional logic button naming in field settings.
- Inconsistent Form Builder JS events loading order in jQuery 3+ across different browsers.
- Form title issue on a single entry screen when using a specific combination of Access Control settings.

## [1.6.6] - 2021-03-30
### Added
- Ability to delete uploaded files when editing a form entry.
- Delete all uploaded files to clean up space when the associated entry is deleted.
- Support currencies with no decimals.
- WordPress 5.7 new color scheme compatibility.

### Changed
- Hide the "Add New Notification" button, when the Notifications were turned off.
- Allow using 0/false values in choices label for Checkboxes, Multiple Choice, Dropdown fields.
- Better AJAX form submit error messages handling for the Email field.
- Refactored Tools page with all of its subpages for easier long-term support.
- Exclude Page Break, Custom Captcha, HTML, and Section Divider fields from a single entry export file.
- Updated the WPForms > About Us page.
- Updated Dropzone lib to 5.8.1 (fixes IE11 issue).
- Updated DOMPurify lib to 2.2.7.
- Replaced jQuery.ready() function usage with a recommended way since jQuery 3.0.

### Fixed
- Front-end slow loading of a form with Conditional Logic, when applied to fields with image choices.
- Incorrect Edit Entry page layout where fields are rendered, when fields have custom CSS classes that modify the form structure (i.e. by adding columns).
- HTML layout is broken on the Analytics page for some site languages.
- Incorrect permission checks for different places in the dashboard and the Form Builder.
- RTL support for Name, Email, Password, Address, and Date/Time fields.
- Incorrect total form count value for different user's roles on the Forms Overview page (All Forms).
- Speed up the Form Builder rendering by loading certain scripts only when the Embed functionality is triggered.
- Validation for Rating Field is still required even though the selection is still showing.
- The `iframe` HTML element was rendered incorrectly in the Twenty Twenty theme.
- The Checkboxes and Multiple Choice fields CSS issues in Twenty Twenty-One theme.
- On WordPress 4.9.0-4.9.4 and certain FTP configurations there could be an error while trying to automatically download the translations.
- Omit Dynamic Choices fields from conditional logic settings.
- Allowlist/Denylist validation was broken for the Email field in a multi-page form.
- Error message text was missing or incorrect when an addon installation failed on certain WordPress/server configurations.
- Correctly format big amounts in the Single Item payment field.
- Single Item payment field shows an "Amount mismatch" error on the form submit on PHP 8.0.
- PHP notice generated while exporting a form with the Divider field, which has Conditional Logic.
- PHP fatal error generated when using `{entry_date format="m/d/Y"}` smart tag in a Notification message of the plugin Lite version.
- Display the Payment Gateway Information option on the Entries Export page only if any of the payment addons is active.
- Incorrect WPForms custom capabilities display in the Members plugin.
- Columns sorting on the Forms Overview page made by non-administrators (using the Access Control functionality) could break forms in certain cases.
- WPForms Challenge was drunk in the Firefox browser.
- reCAPTCHA doesn't render in a popup when the same form exists in another place.

## [1.6.5.1] - 2021-02-23
### Fixed
- Incorrect validation in the Single Item field with 'user defined' type and 'required' status when paying in thousands.
- PHP notice while exporting a form template with no form fields.
- On certain WordPress/server configurations there could be an error while trying to automatically download the translations.

## [1.6.5] - 2021-02-16
### Added
- Automatically download translation files for the core plugin and its addons.
- Export all entries in the Microsoft Excel (.xslx) format, which should fix CSV-related compatibility issues.
- Clone Notifications in the Form Builder to quickly recreate a lot of them.

### Changed
- Updated DOMPurify lib to 2.2.6.
- Convert "Viewed" and "Starred" export entry values to "Yes"/"No".
- Reload the Form Builder after Save and Embed option usage, and going back using the browser Back button.
- Improved empty states for Single Entry view.
- Disable From Name and From Email fields in Form Builder > Notifications when the WP Mail SMTP plugin forces those values.

### Fixed
- RTL support for the Smart Phone field.
- Properly display entry time when the site has a timezone with fractional offset.
- The Gutenberg block JavaScript issue in WordPress 5.0-5.1.1 versions.
- The Gutenberg block CSS issues in Twenty Twenty-One theme.
- AMP incompatible script for Lite version.
- Address field should have US country pre-defined when US mode is active.
- Multiple choice selected choice resets to default while editing the entry.
- Logs records on WPForms > Tools > Logs may not be clickable under certain circumstances, preventing previewing the logged information.
- Email Summaries ignoring timezone offset while generating reports.
- CSS issue in WordPress 5.5+: the form title centered on single entry view if starred.
- Email Suggestion feature when using two or more forms on a page.
- Shorten the names of uploaded files to avoid broken links on a single Entry page and in emails.
- Missing on-hover tooltips' after cloning/duplicating elements in the Form Builder (Notifications, fields, etc).
- Minor styling issues on the WPForms > Tools > Logs page.
- Issues while importing forms saved in UTF-8 with BOM.
- Improve performance of the WPForms Challenge.
- WPForms module icon compatibility with the latest Elementor version.
- Incorrect CPT and taxonomy terms alphabetical sorting of the Dynamic Choice option values for fields that support this Advanced Option.
- Properly clean up all orphaned CSV files after the export has been completed.
- Compatibility with WordPress 4.9 on the WPForms > Analytics/SMTP pages.
- Incorrect required File Upload field post-processing when upload failed.
- AJAX form submissions and file uploading on some server configuration.
- Improve Admin Menu Bar support since WordPress 5.2.
- Do not allow submitting the form with required but empty (or equal to 0) user-defined Single Item payment field value.

## [1.6.4.1] - 2020-12-28
### Added
- Frontend form warning indicating missing WPForms JS (visible to admin only).

### Changed
- Help hCaptcha process all requests in a more efficient way, so bot detection will work better.

### Fixed
- Improve pagination on Tools > Logs page inside the plugin admin area.
- Various JavaScript issues on create post/page/form pages in WordPress 5.6.
- Edge cases when custom fields mapping for providers was broken.

## [1.6.4] - 2020-12-16
### Added
- hCaptcha support, see WPForms > CAPTCHA settings.
- Show confirmation modal when deleting entries using bulk actions method.
- Character/word limit validation message control inside Settings > Validation page.

### Changed
- Display a notification to a user in the Form Builder that outlines all the consequences of disabling entry storage.
- Dropdown and Dropdown Items fields using the Modern format will only show the search option if at least 8 choices are provided.
- Updated jQuery inputmask library to v5.0.6-beta20
- Improved Form Builder Help documentation caching.
- Only create our Logs database table when specifically enabled in the Tools settings.
- Updated WPForms install count and rating information.
- Allowed WPForms plugin and addons auto-update control in WP 5.5+.
- Added "Copy to Clipboard" button inside Form Embed modal.
- Entries page: "Delete All" button deletes filtered entries only if any filtering is applied.

### Fixed
- PHP Warning caused by Email field changes.
- Editing multiline text in Paragraph field breaks new lines in submitted text.
- Javascript conflicts with IE11.
- Possible errors if web host had `set_time_limit()` disabled.
- Form builder Date/Time field date format resetting after refresh.
- Email validation issue if form is in a page multiple times.
- Conditional form confirmation processing issue if one of the confirmations was not correctly configured.
- Footer links in the Summary email are now working properly.
- Double-click issue for "Add New Account" buttons on the Settings > Integrations page.
- Advanced Options for Date / Time field are not logically ordered for conditional logic.
- Required Date dropdown field shows three validation messages instead of one.
- Search/Filter displays incorrect number of results on Entries screen.
- Gutenberg block ignores "Include Form Styling" setting and forces full CSS stylesheet.

## [1.6.3.1] - 2020-10-21
### Fixed
- Entry timestamps could be off by several hours for certain timezones.
- Form title display issue inside the form builder with smaller view ports.
- Elementor widget display issue on frontend when no form has been created.
- Addons page activation/deactivation failing.

## [1.6.3] - 2020-10-15
### Added
- Native integration with Divi.
- Email field Allowlist/Denylist restrictions, see Email field Advanced Options.
- Date/Time field restrictions, see Date/Time field Advanced Options.
- Form builder Help - contextual help, search docs, and more.
- Breadcrumb navigation when searching/filtering entries.
- Logging, which can be enabled for troubleshooting from WPForms > Tools > Logs.
- Site Health check to detect if WPForms uploads directory is writable.
- `{entry_date format="m/d/Y"}` smart tag.

### Changed
- Nicely notify users in the Form Builder when their WordPress session has expired, and they can't save the form anymore without a page reload.
- Better AJAX form submit field error messages handling.
- Updated IntlTel javascript library.

### Fixed
- Custom metabox heading styling due to WordPress core changes.
- Page title smart tag not working in some use cases when using AJAX form submissions.
- Smart phone field assets loading when US or International formats are selected.
- Various admin area display issues when the field label is empty.
- Logo Translate plugin integration issues.
- Addons page grid display issues.
- Elementor widget edge case issues.
- Filtering entries by the date given incorrect results due to timezones.
- Form submit button disabled state issues when using Modern file upload format.
- Form settings could be visible before the form was created.
- Form builder styling inconsistencies with Dropdown field styles.
- Input mask issues with some mobile browsers, notably Chrome.
- Database migration errors in some edge cases during plugin updates.
- Always display the WPForms admin area in the user's language regardless of the site language.
- Do not load certain JS variables twice on the front end.
- Conditional logic for modern dropdown and payment dropdown fields should properly process ending space in field values.

## [1.6.2.3] - 2020-09-08
### Changed
- Added shortcode access to a form embed modal and enhanced modal navigation.
- Improved empty states for All Forms, Entries list, and Builder no fields preview panel.
- Improved Email Summaries footer text.
- Updated bundled Dropzone.js library to 5.7.2.

### Fixed
- Properly export 0 (zero) values in field values.
- Properly handle required Lite files translations for the Pro version of the plugin.
- Allow unmapping all custom fields in some marketing providers' settings.
- Properly display seconds (instead of ms) in Modern File Upload field error message when a timeout is reached.
- Custom validation messages for the fields appear correctly with Ajax form submission enabled.
- Base style CSS introduces no additional scrollbars now.
- Clicking the "Next" button won't submit a multi-page form until the page is ready.
- Correct cursor for image choices validation messages.
- Address field "Hide subfields" checkbox got a more unique visibility toggle class.
- Getting the license details from DB works as expected regardless of a context.
- Getting the list of WPForms addons for user license level works as expected regardless of a context.
- Number Slider field increment is checked to be more than zero.
- "Show/Hide Empty Fields" toggle behavior is now consistent on both Single Entry and Print Single Entry pages.
- Modern Dropdown validation works as expected for AJAX forms.
- Properly support drag-n-drop on tablets in the Forms Builder.

## [1.6.2.2] - 2020-08-11
### Changed
- Disable for now auto-updates plugins feature (introduced in WordPress 5.5) for the WPForms core plugin and all of its addons.

### Fixed
- Do not allow Action Scheduler to generate errors during the plugin uninstallation procedure.
- Front-end error gets displayed (instead of failing silently) when honeypot is triggered by external code.
- Form embed wizard popup should be loaded only when it can actually be used.
- Input mask validation produces a JS error on jQuery 3.x.

## [1.6.2.1] - 2020-08-07
### Changed
- Rephrased anti-spam protection error to provide more context.

### Fixed
- Entries export displays an error while preparing an export file.
- "Single Line Text" and "Paragraph Text" calculate empty field word count incorrectly.

## [1.6.2] - 2020-08-05
### Added
- Caching friendly anti-spam protection (form tokens).
- Upload files using chunks while using the Modern File Upload field.
- Native integration with Elementor: add to the page and create new forms right inside its builder.
- Add a preview to the WPForms Gutenberg block.
- "Show price after item labels" option for Payments fields.
- File upload original file name is stored and sanitized as a string (not as a file name).
- Display entry submission time in a Date column in Entries table.

### Changed
- Greatly improve WPForms Challenge experience.
- Improve word counting when the Limit Length field option is used with Single Line Text/Paragraph Text fields.
- Improve Number field input restrictions with various browsers.
- Form field validation will now fail if input mask is enabled and user input does not complete required input mask elements.
- Icon for the Multiple Choice field is now more representative.
- Hide Delete button for a "Default Notification" in the Form Builder.
- Improve Lite migrations for WordPress Multisite installations.
- Update Constant Contact, Stripe, Mailchimp, and GetResponse logos because of their rebranding.
- Improve descriptions of various plugin options and add more context to them.

### Fixed
- Properly map fields in various addons when the first field is added in the Form Builder.
- Issue when editing Checkbox field entry values when dynamic choices were enabled and multiple values were saved.
- Date Time field is not always properly populated on the Edit Entry page.
- Entries table is not created when upgrading from Lite to Pro using zip.
- Pro install date is not logged correctly when upgrading from Lite to Pro using zip.
- Improve the way conditional logic templates are rendered inside the Form Builder.
- Refresh the list of form fields that are required to properly render marketing addons.
- "Invalid Form" error for logged out users upon submitting an AJAX form on some server configurations.
- Multiple Choice fields had issues in the builder with image choices with empty labels.
- Improve error handling on the back-end while processing files that were uploaded using the Modern File Upload field and failed validations.
- Make bulk actions at the bottom of the Forms Overview work.

## [1.6.1.2] - 2020-07-08
### Added
- Data encryption/decryption tools to use within the WPForms ecosystem.
- PHPMailer v6 compatibility that will come with WordPress 5.5.

### Fixed
- Entries export fails to finish when the number of entries is too large.

## [1.6.1.1] - 2020-06-30
### Fixed
- Smart Phone field should correctly submit its default value.
- Properly handle nested Conditional Logic for Dropdown fields (field depends on a field that depends on a field that depends on a field etc).

## [1.6.1] - 2020-06-23
### Added
- Display a list of scheduled actions on WPForms > Tools > Scheduled Actions page.
- Multiple select option for Dropdown field (off by default).
- New Modern style option for Dropdown and Payment Dropdown fields (off by default).
- Support Smart Tags in form descriptions.

### Changed
- Uploaded files to the WordPress Media library will now have a generated title and description based on field label and description.

### Fixed
- Properly handle multiple clicks on various accordion-like elements on Form Builder and Settings > Integrations pages.
- Remove all the plugin-related information on uninstall from the DB when opted-in in plugin settings.
- Avoid unnecessary DB queries when loading the Export Entries functionality.
- Some plugins when generating own errors displayed the source of the issue in WPForms, not anymore. We simplified error handling.
- Replace all new lines characters with spaces in notification email subjects (e.g., when an address field value is used in a subject via a smart tag).
- Use a new filter `set_screen_option_{$option}` on the Forms and Entries pages for better compatibility with WP 5.4.2.
- Make sure the plugin doesn't crash when `iconv` PHP extension is not installed on a server.
- Improve the look of the Conditional Logic configuration area in the Form Builder on tablets.
- Conditional logic should work correctly when it depends on a field with ID=0.
- HTML Field Label should be carried over when the field is duplicated.
- Properly handle fields with choices with new lines in their labels when connected to Conditional Logic.
- Google Invisible v2 reCAPTCHA should show Submit Button Processing Text when the form is submitted.
- A lot of searches on the Entries page could result in server failure.
- Display inline validation for required Smart Phone field, when there are multiple such fields in a form.
- Update the library used for Smart Phone field, which has fixed known mobile issues and duplicated IDs for the field.
- Display the list of countries in the "Countries" preset and in the Address field in alphabetical order regardless of the current site language.
- Entry editing not properly displaying all 0 (zero) field values.
- Error if entry editing contained an empty required field.

## [1.6.0.2] - 2020-05-19
### Added
- Helper functions to dequeue scripts/styles by URI.

### Fixed
- Phone field should not allow alphabet input but allow spaces.
- Product education URL encoding issues.
- Large forms with numerous conditional logic rules experience significant UI slowdowns in the Form Builder.
- The default value 0 (zero) of the Paragraph Text field does not display on the front end.
- Securely store WPForms anonymized cookie, so it cannot be sent along with cross-site requests (samesite).
- Entries list page on mobile devices was unusable: columns were not shown properly, links for each entry in a table were unclickable.
- Various PHP notices that may appear during wildly complicated forms submissions.
- Improved escaping inside Form Builder live preview, props Fortinet Fortiguard Labs.
- Date field format defaults to YYYY-MM-DD format no matter what format is selected.
- Page break field should always behave correctly on front end even when its settings are broken.
- Incorrect interval value was used when running a cleanup job after notifications sent.
- Correctly display Smart phone field country selection on mobile.
- Improved plugin custom capabilities handling inside the WordPress admin area.
- Do not generate errors when editing entries for forms that don't have fields anymore.
- Delete orphaned plugin translation files when cleanup option in plugin settings is checked and the plugin is deleted from the site.
- Prevent entry duplicates creation by improving permissions check when allowing non-admins to edit entries.
- Improved error handling when dealing with entries exporting weird errors.

## [1.6.0.1] - 2020-04-16
### Fixed
- Compatibility issues with older versions of Surveys and Polls addon.

## [1.6.0] - 2020-04-15
### Added
- Forms entry editing.
- Admin bar menu item.
- Conditional logic support for the Divider field.
- Form Builder alert when using browser "Back" button if form contains unsaved changes.
- Settings > Emails: "Optimize Email Sending" option which enables sending emails asynchronously.
- Auto-download translations on plugin activation.

### Changed
- Async form notification emails are now off by default.
- Date field can be cleared when using the Date Picker.
- Number Slider field display improvements on small devices.
- Do not cache entry counts on Entries Overview page.

### Fixed
- Error if there are some plugins or themes add `widget_title` filter.
- Front-end compatibility with Rating field and jQuery 3.x.
- Choice Images not displaying in form notifications if no label is set.
- Email/Password field Advanced Options not always displaying correct options.
- Page Break field "Disable Scroll Animation" option not working as expected.
- Form Builder "drag zone" not available when all fields are deleted.
- Uploaded file names are not truly unique in very rare cases.
- Empty `div` appended to end of form display.
- Block alignment issues (WordPress 5.4+).
- Form Builder field option panel is not available if field is placed before the last form field.
- Conditional confirmation error when '<' symbol is used as a field option.
- Display placeholders for Date/Time field when dropdown date option is selected and Conditional Logic applied to the field.
- Fallback population for fields with choices (checkbox, radio etc) when special characters are used.
- Entries export support external storage for temporary CSV files.
- Integrity of decoded data with additional sanitizing.
- Compatibility issues with Elementor.

## [1.5.9.4] - 2020-03-19
### Changed
- Improve async notification emails scheduling compatibility with certain caching plugins and site installs.

## [1.5.9.3] - 2020-03-18
### Fixed
- Some smart tags are not rendered correctly in the email notifications if sent asynchronously.

## [1.5.9.2] - 2020-03-09
### Fixed
- PHP error for those upgrading from < 1.5.4.2.

## [1.5.9.1] - 2020-03-05
### Fixed
- Checkbox image click doesn't work well to select an option.
- Do not allow empty connection names (spaces only) for providers.
- File Upload field: properly handle `{field_value_id="#"}` smart tag.
- Provide proper defaults to Date / Time field, only when Date or only Time format is selected.

## [1.5.9] - 2020-03-03
### IMPORTANT
- Support for PHP 5.4 has been discontinued. If you are running PHP 5.4, you MUST upgrade PHP before installing WPForms 1.5.9. Failure to do that will disable WPForms core functionality.

### Added
- Access Controls settings panel smart suggestions.
- Helpful links for Lite and Pro users under plugin name on Plugins page.
- Additional option to export Payment Status when exporting entries.
- Capability check for `wpforms()->entry_fields->get_fields()`.
- New hooks and filters in several places, e.g. pre-deletion for entries/forms.
- Safety-check on plugin Settings page to make sure all custom DB tables are present.
- Async/scheduled tasks management support (e.g. sending emails in the background).

### Changed
- Update the "How to Create Your First Contact Form" video URL.
- Update the "How to Embed A Form" video URL in a Form Builder "Embed" modal.
- Datepicker type change refreshes a list of available Date formats in "Date/Time" field.
- Make the plugin consistent with the updated Mailchimp branding (MailChimp to Mailchimp).
- Number Slider field: allow empty value in "Value Display" option.
- Improved admin input field focus states to be more consistent with WordPress core.

### Fixed
- Numbers/Numbers Slider field: allow `0` value in email notifications and field smart tags output.
- Required Checkbox fields with `0` value not passing validation.
- Multiple Choice field could generate a PHP notice when the form was created after using a custom form template.
- Initialize tooltips properly for newly created Notifications/Confirmations.
- Ajax button should be re-enabled after incorrect form submission.
- Remove Javascript alert notice when form is viewed in AMP.
- Improve compatibility with the "Lazy Loading Feature Plugin" for Ajax spinner image on front-end.
- Invalid payment amount when empty Payment Checkbox field is used in conditional logic.
- Modern File Upload field validation issue.
- Entry information not fully deleted when using "Delete All" link from entries table view.
- Validation issue with required Checkbox fields using Image Choices.
- Form builder preview issue with a field using Dynamic Choices setting.
- Australian mobile phone numbers not passing Smart Phone Field validation (updated intl-tel-put library).
- Number Field values not allowing leading zeros.
- Form Builder: templates search bar shows icon over text.
- Security hardening and improvements.

## [1.5.8.2] - 2020-01-13
### Fixed
- "Cannot modify header information" warning in Pro/Access/Capabilities.php.
- Can't add new line in textareas in the form builder (Notifications > Message etc).
- Choices editing block inside the form builder is hidden if creating a form using a template.

## [1.5.8.1] - 2020-01-09
### Fixed
- "Invalid form" error on form submit if AJAX form submissions is enabled and user is not logged in.

## [1.5.8] - 2020-01-09
### Added
- Access Controls: let admin control permissions based on website users’ roles via WPForms specific capabilities (with own UI and integration with MemberPress and User Role Editor).
- Post ID to the Entry details on single entry page for Post Submissions entries (works with any CPT).
- Better Phone field validation for both US and International formats with an ability to redefine error message on incorrect field value.

### Changed
- Sullie logo in the Form Builder got his left hand back.
- Improve the way URL validation is done for "Website / URL" field.
- Hide image choices options if dynamic choices is enabled.
- Do not allow to disable Entry storage when Payments are already enabled.
- Adjusted Number field input to improve consistency across different browsers/devices.
- Improve Block detection to load CSS styles earlier.
- Open New Provider Connection modal after account has been added.
- Process fields/notifications/confirmations conditional logic as usual when CL rule is not fully configured (selected rule field is required).
- Improve the way Lite and Pro versions of the plugin activation handled.
- Remove the unnecessary "Required" setting from a Number Slider field.

### Fixed
- Number slider incorrect label display in the form Builder preview panel.
- Browser's autofill for address zip code field is incorrect.
- Quick links menu generating browser console error on Survey Print results page.
- Required validation message isn't removed immediately on choices selection.
- Incorrect conditional logic processing for payment "Checkbox Items" field when multiple choices selected.
- Form Builder styles compatibility with the new WordPress 5.3 styles.
- Correctly process Enter key press in Smart phone field when Enter is used to submit a form.
- Remove not-needed GET params from URL in Builder when a new form created to prevent race conditions with certain providers loading logic.
- Display all selected choices (checkboxes) in the survey results.
- Properly navigate between pages in a multi-page form when Enter is pressed.
- Properly scroll in all major browsers to a faulty field in a form, including multi-page forms.
- Properly work with negative numbers in Conditional logic "greater/less than" operators.
- Optimize multi-page forms progress indicators for the small screens.
- Multi-page page breaks incorrectly allowed "Previous" button display in the Builder.
- Modern file upload: improve upload area hint translations support.
- RTL support for Phone field, correctly display on both front-end and back-end of the site.
- Entry export "Payment Gateway Information" not available when Stripe addon is active.
- Dropdown Items field not properly handling Fallback field population.
- Textarea character limit check returns an error if the content pasted is too large and contains '\r\n' line breaks.

## [1.5.7] - 2019-12-12
### Added
- Number Slider field.
- reCAPTCHA field in Form Builder allowing to easily manage the reCAPTCHA for a form.
- Label setting for HTML fields to more easily identify them inside the form builder.
- Ability to display Entry ID and Entry Notes columns in a list of form entries.
- Entry Log metabox for a single entry view, tracks starring/unstarring and reading/unreading entry.
- Admin area quick links menu.
- Analytics sub-menu page.
- SMTP sub-menu page.
- New advanced option for Page Break field: disable scroll animation.

### Changed
- Improved smart Phone field RTL support.
- Improved forms bulk actions processing.
- Added a Form Builder splash screen which is displayed on mobile devices.
- Display warning message if JavaScript is disabled in the browser.
- Improved "About Us > Versus" page with more details regarding various license types.
- Improved Form Builder Page Break Progress Indicator discovery.
- Improved form front-end display and alignment for Gutenberg focused themes.
- Improved invisible reCAPTCHA behavior when form is submitted.
- Improved actions and filters for notification emails.

### Fixed
- Duplicate of the duplicated form created on page reload.
- Modern file uploader: field styles in Gutenberg editor.
- Modern file uploader: prevent errors when malformed data submitted.
- Do not submit the form via AJAX (if enabled in form settings) when in AMP mode.
- Quotation marks inside Entry Notes being slashed.
- WordPress 5.3 admin area styling issues.
- Modern File Upload hidden input styling issues.
- Number field incorrectly processing negative numbers.
- `page_url` Smart Tag issues.

## [1.5.6.2] - 2019-11-07
### Added
- Default value for "Paragraph text" field.

### Fixed
- WordPress 5.3 compatibility.
- Smart Phone countries squashed dropdown on screen-width <= 600px on themes with Base form styling selected.
- Properly include Pro form templates on form creation screen in a template selection section.
- Classic file uploader: correctly handle uploaded files with the same name.
- Field's Default value `0` disappears after saving and exiting the form builder.
- Smart Email field did not recognize `.dev` top level domains as valid.

### Changed
- Clear DashBoard widget cache and Default Entries Screen cache on entry deletion.

## [1.5.6.1] - 2019-10-30
### Fixed
- Modern file uploader: correctly process post_max_size value from php.ini (js should not send that file at all).
- Modern file uploader: make error message more clear when a file was not uploaded.
- Modern file uploader: when file is being uploaded do not change Submit button text.
- Modern file uploader: correctly process WordPress Media library integration and conditional logic.
- Modern file uploader: some servers don't have mime extension installed, so use WP function to determine mime type.
- Compatibility with WordPress 5.3 and its changed `\WP_Upgrader_Skin::feedback()` method signature.

## [1.5.6] - 2019-10-23
### IMPORTANT
- Support for PHP 5.3 has been discontinued. If you are running PHP 5.3, you MUST upgrade PHP before installing WPForms 1.5.6. Failure to do that will disable WPForms core functionality.

### Added
- "Modern" Style File Upload field setting with support for multiple files, AJAX, progress bar, and more!
- Single Line Text/Paragraph fields limitation options (limit by character or word count).
- "Community" sub-menu page for easy access to helpful resources and links.

### Fixed
- Translations not correctly downloading, causing text to be partially translated.
- Stricter rules for displaying a plugin Welcome Page.

### Changed
- Minimum PHP version requirement is now PHP 5.4.
- Minimum WordPress version requirement is now WordPress 4.9.

## [1.5.5.2] - 2019-09-18
### Added
- Compatibility with WPForms Stripe v2.3.

### Fixed
- Minor issues and enhancements.

## [1.5.5.1] - 2019-09-17
### Added
- New filter to display additional fields to filter entries on Entries page.
- New filters to add additional information into entries exported CSV file.

### Fixed
- Broken reCAPTCHA checkbox in Builder > Settings > General if reCAPTCHA type does not set in WPForms > Settings.
- CSV Download adding `.html` extension to initially a CSV file in Safari on MacOS.
- Fields default values do not show if conditional logic is enabled.
- Smart tag `{entry_id}` should not be available for fields, because it is available only after entry saving.
- Email field server-side validation issue.
- Broken "Bulk add" option in Builder in IE 11.
- Broken image choices selection and styling (layout) issue in IE 11.
- Redirect to PayPal payment doesn't work when AJAX form submission is On.
- Backward compatible filters for some fields when displaying them were missing.

## [1.5.5] - 2019-08-28
### Added
- New default screen for the Entries list page (WPForms > Entries).
- New flexible Entry Exporting (WPForms > Tools > Export).
- WPForms details inside Site Health Info reports (Tools > Site Health > Info).
- Filter `wpforms_emails_summaries_is_disabled` to easily disable Email Summaries functionality.
- New smart tag: `{field_html_id="42"}` - that will postprocess field value and display its HTML representation.

### Changed
- Improve `wpforms_get_ip()` IP detection and related `{user_ip}` smart-tag value.

### Fixed
- Giving access to WPForms for Editors (and other roles) should give access to dashboard widget as well.
- Dashboard Widget displays entries chart and count for the last 8 days, not 7.
- Add 'attr' property to 'input_container' for radio/checkbox-based fields.
- Various typos.
- WP Mail SMTP plugin description on About us page.
- Set HKD currency symbol ($) position to the left.
- Avoid horizontal scroll on mobile devices when using File Upload field.

## [1.5.4.2] - 2019-08-06
### Changed
- Renamed certain actions with typos in their names, backwards-compatible. Added a deprecation text using `do_action_deprecated()`.
- Geolocation API endpoint (used for "smart" phone field).

### Fixed
- About Us page behaviour when WP Mail SMTP Pro is installed.
- Elite licenses could not install addons from inside the form builder.
- Rating field icon color not changing on front end with some themes.
- reCAPTCHA settings could be saved without providing reCAPTCHA type.
- Entry database tables not created for some users upgrading from WPForms Lite.

## [1.5.4.1] - 2019-07-31
### Fixed
- Plugin Settings > Misc > 'View Email Summary Example' link errors.

## [1.5.4] - 2019-07-30
### Added
- Email Summaries.
- Form builder hotkey to save changes, CTRL + S.

### Changed
- Team photo under WPForms > About Us. :)

### Fixed
- Dynamic field population populates checkbox and radio fields values but not adding 'wpforms-selected' class to its containers.
- Dropdown and Dropdown Items field attributes are now accessible with `wpforms_field_properties` filter.
- Form builder field buttons overflowing when translated.
- Dashboard widget PHP error.
- Form can be submitted multiple times if "Submit button processing text" form setting empty.
- "Error loading block" in Gutenberg if Additional CSS form settings are provided.
- Incorrect payment amount displayed in some cases.

## [1.5.3.1] - 2019-06-18
### Fixed
- Checkbox field validation issue when field is not required.

## [1.5.3] - 2019-06-17
### Added
- AJAX form submissions.
- Google reCAPTCHA v3.
- AMP support.

### Changed
- WPForms uninstall script for better cleanup process.
- Email field mailcheck feature to offer additional controls. New filters: `wpforms_mailcheck_enabled`, `wpforms_mailcheck_domains`, and `wpforms_mailcheck_toplevel_domains`.

### Fixed
- File Upload fields issue in Microsoft Edge.
- Special characters aren't encoded when Smart Tags are processed in query string.
- Fields with Image choices are not working with some Android and older desktop browsers.
- Payment Total field value includes conditionally hidden Single item fields.
- Front-end and notification emails incorrect payment amount for some currencies if the value is greater than 1000.
- Conditional Logic: Payment Checkbox Items multiple selection issue.
- Form Builder: Several alert modals are displayed in batch if multiple providers have configuration issues.
- `WP_Post` object is returned from `wpforms()->form->get()` if form data is requested with a non-WPForms post ID.
- Inconsistent Enter key behaviour in multi-page forms.
- Unable to get a specific entry with `wpforms()->entry->get_entries()` without giving the form id.

## [1.5.2.3] - 2019-04-23
### Fixed
- PHP error if checkbox field is empty when form is submitted.
- Validate all :input fields (not only required) when navigating multi-page forms.
- Conditional logic conflicts using checkboxes/dropdowns with options "false" or "0".
- Use of JavaScript Array Prototype Constructor breaks conditional logic.

## [1.5.2.2] - 2019-04-15
### Fixed
- PHP notice/warnings from undefined constant (typo).
- Addons screen not populating for all license levels.

## [1.5.2.1] - 2019-04-11
### Fixed
- Entry print preview page not supporting non-UTF8 charsets.
- Entry print preview page not displaying entry notes.
- Required Checkbox fields asking for all inputs to be checked to pass validation.

## [1.5.2] - 2019-04-10
### Added
- Smart format for Phone fields.
- Choice Limit advanced option for Checkbox fields.
- Smart domain name typo detection for Email fields.
- New Gutenberg block keywords to help with discovery.
- Link to "How to Properly Test Your WordPress Forms Before Launching" doc inside Gutenberg block.
- Filter `wpforms_upload_root` to change uploads location.

### Changed
- Form builder field delete icon, now a trash can.
- Removed legacy check for conditional logic.
- Improved Entries list table on small devices.
- User IP detection method, now filterable.
- Updated flatpickr JS library to v4.5.5.
- Updated jQuery inputmask library to v4.0.6.
- Updated jQuery validation plugin to v1.19.0.
- Clear Dashboard widget cache when form is created/deleted/updated.

### Fixed
- Blank form if using form template containing `target="_blank"`.
- Honeypot field not using unique IDs.
- Duplicating forms creating another duplicate if afterwards the table was sorted.
- Minor issues with Gutenberg editor.
- Browser autocomplete conflict with US address zipcode input mask.
- Form Builder embed modal showing Classic Editor instructions for Gutenberg users.
- No detection or errors if combined multiple file uploads size is greater than `post_max_size`.
- Number field allowing non-numerical characters on iOS devices.
- Incorrect data in CSV entry exports if fields have been deleted.
- Field Dynamic Choices not showing in form preview when using "Post Type".

## [1.5.1.3] - 2019-03-14
### Fixed
- Styling issue with single entry previous/next buttons.
- Importing forms that containing `target="_blank"`.
- Issues with duplicating Form Notifications and conditional logic rules inside Form Notifications.
- Quote support/display inside query param Smart Tags.
- Addon cache not clearing when license key is switched or deactivated.
- Other minor fixes.

## [1.5.1.2] - 2019-02-28
### Fixed
- Conditional logic issue with Checkbox/Multiple choice fields when default values are set.

## [1.5.1.1] - 2019-02-26
### Fixed
- Conflict with WordPress 5.1 if form contained target="_blank".
- Long field labels cut off when viewed in Entry Print page compact view.
- PHP notices on Entry Print page.
- PHP notices on Entries page.
- Unable to uncheck default Multiple Choice value in form builder after being set initially.
- PHP error when entries are exported after a field has been deleted.
- Form builder Email notification conditional logic settings display issue after new notification is added.
- Conflict with some themes preventing Multiple Choice fields from being selectable.

## [1.5.1] - 2019-02-06
### Added
- Checkbox Items field (payment checkboxes).
- Complete translations for Spanish, Italian, Japanese, and German.
- Improved form builder education and workflows: install and activate any addon without ever leaving the form builder!
- Smart Tag for referencing user meta data, `{user_meta key=""}`.

### Changed
- Removed limit on Entry Columns when customizing.
- Improved support with LocoTranslate plugin.
- Refactored Form Preview functionality, no longer requiring hidden private page to be created.
- Always load full WPForms styling inside Gutenberg so forms render correctly.

### Fixed
- Entry counts getting off sync with entry heartbeat detection.
- Typos, grammar, and other i18n related issues.
- Created alias class for `WPForms` to prevent issue with namespace introduced in 1.5.0.
- Dynamic population issue when using Image Choices field.

## [1.5.0.4] - 2018-12-20
### Changed
- Dashboard widget improvements.

### Fixed
- Various typos.

## [1.5.0.3] - 2018-12-06
### Changed
- Minor improvements to Gutenberg block for WordPress 5.0.

### Fixed
- Error when activating WPForms Pro if WPForms Lite is still activated.

## [1.5.0.2] - 2018-12-03
### Fixed
- File Upload validation issue if max file size was defined.
- Dashboard widget appearance on Windows.

## [1.5.0.1] - 2018-11-28
### Fixed
- Required validation enforcement on Date Time fields.

## [1.5.0] - 2018-11-28
### IMPORTANT
- Support for PHP 5.2 has been discontinued. If you are running PHP 5.2, you MUST upgrade PHP before installing WPForms 1.5. Failure to do that will disable WPForms core functionality.

### Added
- Dashboard widget with basic reporting.
- WPForms Challenge: an interactive step-by-step guide to creating a form for new users.
- Dynamic field population, available to enable from form settings.
- New entries "heartbeat" notification on entries list screen.
- "About Us" admin page (WPForms > About Us).
- {user_first_name} and {user_last_name} Smart Tags.

### Changed
- Improved randomizing if field is configured to randomize items.
- Improved file size validations with multiple uploads.
- Improved i18n support.

### Fixed
- Form builder errors if user had Visual Editor disabled in profile.
- Form builder Windows styling issues.
- Form builder dynamic choices warning not always removing.
- Form builder "Show Layout" CSS formatting.
- reCAPTCHA compatibility when form is inside OptinMonster popup.
- PHP errors if form does not contain entries.
- Validation and formatting issues on some fields if submitted value is zero.
- File upload javascript validation conflicting with multi-page forms.
- Gutenberg block returning error if no forms have been created.

## [1.4.9] - 2018-09-18
### Added
- Pirate Forms importer.

### Changed
- Some form builder tooltips to contain documentation links.

### Fixed
- Form builder javascript conflict with jQuery non-conflict mode.
- RTL issue with Phone field when using input masks.
- PHP Notice from WPForms widget.
- Incorrect markup around Addons submenu item.

## [1.4.8.1] - 2018-08-21
### Fixed
- Certain confirmation settings, before 1.4.8, not displaying correctly in the form builder.
- Compatibility issue with MySQL `Strict_Trans_Tables` mode (again).

## [1.4.8] - 2018-08-28
### Added
- Gutenberg block.
- Conditional form confirmations - forms can now have multiple confirmations with conditional logic!
- WP Mail SMTP detection and hints in the form builder notification settings.
- Alt and title tags to image choices images on front-end display.

### Changed
- Improved Website URL field front-end validation - now automatically adds protocol if omitted.
- i18n improvements.

### Fixed
- Compatibility issue with MySQL `Strict_Trans_Tables` mode.
- Incorrect param used with `shortcode_atts`.
- NPS and Rating fields not having access to all conditional logic comparisons.
- Accessing `wpforms_setting` in front-end javascript before checking if it exists.
- Escaping method in HTML field mangling code on save.
- PHP error toggling form builder notifications in some use cases.
- GDPR field Agreement text not updating in real time.
- Marketing provider connections containing an escaped apostrophe.
- Pressing "Enter" in the form builder resulting in unexpected behavior.
- Incorrect pagination when searching entries.
- Security enhancements and other misc bug fixes.

## [1.4.7.2] - 2018-06-21
### Changed
- Adding new choice to Multiple Items field now defaults price to $0.

### Fixed
- Entry ID always displaying 0 when viewing single entry details.
- Honeypot field using a none unique CSS ID.
- Form builder Bulk Add display issues in certain use cases.
- Checkbox field values not saving if Show Values field option is enabled.
- Date Time field date dropdown placeholder text not accessible.

## [1.4.7.1] - 2018-06-07
### Added
- Greater Than and Less Than conditional logic rules.
- Conditional logic support for Net Promoter Score field (Surveys and Polls addon v1.1.0).

### Changed
- Updated Russian translation.

### Fixed
- Various i18n issues.

## [1.4.7] - 2018-06-04
### Added
- New Providers class and functionality. The Drip addon is the first to leverage the new class and existing provider addons will be updated over time.

### Changed
- CSV export columns are now filterable (`wpforms_export_get_csv_cols`).
- Old PHP version (5.2 and 5.3) admin warning adjusted to reflect new August 2018 time line.

### Fixed
- Multiple Choice fields showing as Radio fields in the builder preview when first created.
- Duplicating fields in the form builder causing issues with certain field types.
- Entry ID becomes 0 when resending notifications.
- Escaping issue with provider connection names contained an apostrophe.
- Alignment issues with the Addons page display.
- Incorrect text on the Welcome activation page.

## [1.4.6] - 2018-05-14
### Added
- GDPR Enhancements plugin setting [doc](https://wpforms.com/how-to-create-gdpr-compliant-forms/).
- GDPR Enhancement: Disable User Cookies plugin setting.
- GDPR Enhancement: Disable User Details (IP and User Agent) plugin setting.
- GDPR Enhancement: Disable Storing User Details form setting.
- GDPR Enhancement: User Agreement form field.
- Page break, section divider, and HTML fields can now be enabled in email notifications with a filter [doc](https://wpforms.com/developers/wpforms_email_display_other_fields/).

### Changed
- Hide credit card field unless enabled by a payment addon or with a filter [doc](https://wpforms.com/developers/how-to-enable-credit-card-field-without-stripe-addon/).
- PHP warning that alerts users support for PHP 5.4 and below will be dropped this summer.
- Spam logging, to improve performance.

### Fixed
- Rating and Likert Scale not included in CSV exports.
- Typo in base form CSS.
- Stripping HTML from the checkbox, multiple choice, and multiple payment choice labels in the form builder.
- Unreadable errors if 1-click addon install fails.
- Date and Time field time interval labels not translatable.
- Form builder icon visibility when field labels are hidden.

## [1.4.5.3] - 2018-04-03
### Changed
- Use minified admin assets when appropriate.
- Show helpful doc link in form embed modal.
- Minor improvements with complex conditional logic rule processing.

### Fixed
- Rating and Likert fields missing from CSV exports.
- reCAPTCHA v2 showing in form builder when using Invisible reCAPTCHA.
- Conditional logic rules inception.
- Conditional logic rules with Radio and Checkbox choices not updating until save.
- Remove jQuery shorthand references in `admin-utils` to prevent conflicts.
- Issue with form return hash not processing correctly in some scenarios.

## [1.4.5.2] - 2018-03-20
### Fixed
- Checkbox and Multiple choice fields not validating when inside pagebreaks.
- Incorrect documentation link for Input Mask.
- Input Mask value disappearing when form builder is refreshed.

## [1.4.5.1] - 2018-03-20
### Fixed
- Dynamic choices not displaying correctly for Multiple Choice and Checkbox fields.

## [1.4.5] - 2018-03-15
### Added
- Image choices feature with Checkbox, Multiple Choice and Multiple Payments fields; Images can now be uploaded and displayed with your choices!
- Custom input masks for Single Line Text fields (Advanced Options).
- No-Conflict Mode for Google reCAPTCHA (Settings > reCAPTCHA). Removes other reCAPTCHA occurrences, to prevent conflicts.
- SSL Connection Test (Tools > System Info). Quickly verify that your web host correct supports SSL connections.
- `{user_full_name}` Smart Tag, displays users first and last name.
- Disclaimer / Terms of Service Display formatting option for Checkbox fields (Advanced Options).
- Basic CSS styling for `disabled` fields.
- Uninstall routine, available from Settings > Misc.
- Form builder performance improvements. Editing a form with hundreds of fields is now 500%+ faster!
- Search field on Addons page to quickly search available Addons.

### Changed
- New Settings tab: Misc, moved Hide Announcements option to new tab.
- "Total" entries column only displays if the form has a gateway configured and enabled.
- `{user_display}` Smart Tag displays user's display name (in most cases, this is the user's name).
- All `<form>` attributes can now be changed via `wpforms_frontend_form_atts` filter.

### Fixed
- Processing and validation of return hashes (primarily used with PayPal Standard addon).
- Smart Tag usage in confirmation messages displayed from return hashes (primarily used with PayPal Standard addon).
- Form builder tab icon alignment conflicts with third party plugin CSS.
- Smart Tag dropdown display issues in the form builder.
- Form builder drag and drop area disappearing if all fields are removed from a form.

## [1.4.4.1] - 2018-02-13
### Changed
- Textdomain loading to a later priority.
- Provide entry ID if logging entries to improve performance.
- Allow the `WPForms_Builder` class to be accessible.
- Move the confirmation message `wpautop` to an earlier priority to not conflict with content added using filters.

### Fixed
- Form builder templates area not aligning correctly in some browsers.
- Payment transaction IDs not displaying on entry details page.
- Incorrect permissions check for announcements feed.

## [1.4.4] - 2018-01-30
### Added
- Form entries searching; search by specific field or across all fields, multiple conditionals available (is, is not, contains, does not contain).
- Form entries filtering by date; e.g. show form entries from Dec 1 - Dec 31 2017.
- Rating field.
- Advanced setting for Multiple Choice and Checkbox fields to randomize choices.
- Filter for Date Time date dropdown select inputs, to customize ranges (`wpforms_datetime_date_dropdowns`).

### Changed
- Lists (both ordered and unordered) used in the HTML field now have basic styling if using full form theme setting.
- Admin menu icons now uses SVG instead of custom font icon.
- Reviewed all translatable strings, improved escaping and formatting .
- External links have `rel="noopener noreferrer"` improve security.
- Permission check centralized into a single function (`wpforms_current_user_can()`).
- Required label field text centralized into a single function (`wpforms_get_required_label()`).
- Improved list of Countries.

### Fixed
- Conditional logic mismatches due to sanitizing values.
- Typo in German translation.
- Improved i18n for countries.
- Required email provider connection fields not highlighting when left empty.
- Inside form builder, notification name area breaking into multiple lines on smaller screens.
- Total field not updating correctly when multiple forms are on the same page.

## [1.4.3] - 2017-12-04
### Added
- Form entry field values are now stored (additionally) in a new database, `wpforms_entry_fields`, to be used with exciting new features in the near future.
- Upgrade routine for the above mentioned new database.
- Early filter for form data before form output, `wpforms_frontend_form_data`.
- Setting to hide Announcement feed.
- Announcement feed data.

### Changed
- Standardize and tweak modal window button styles.
- Default mail notification settings are now sent "from" the site administrator email; user email is used in Reply-To where applicable (to hopefully improve email deliverability).
- Removed "Hide form name and description" form setting as it was a common source or confusion.
- Provide base styling for `hr` elements inside HTML fields.

### Fixed
- Site cache being flushed when it shouldn't have been, affecting performance in some scenarios.
- Country, state, months and days not properly exposed to i18n.
- CSV export dates not properly using i18n.
- Incorrect usage of `esc_sql` with `wpdb->prepare`.
- Styling preventing the entries column picker from displaying correctly.
- WPForms custom post types omitting labels.
- Smart Tag value encoding issues with email notifications.
- Infinite recursion issue when using Dynamic Values option.
- PHP notice in form builder.

### Changed

## [1.4.2] - 2017-10-25
### Added
- Import your old Ninja Forms or Contact Form 7 forms! (WPForms > Tools > Import).

### Changed
- Date i18n improvements
- Dropdown/Checkbox/Multiple Choice "Show Values" setting has been hidden by default to avoid confusion, can be re-enabled using the `wpforms_fields_show_options_setting` filter.
- Date Time field inputs break into separate lines on mobile to prevent Date picker from going off screen in some scenarios.

### Fixed
- reCAPTCHA now showing in the Form Builder preview when enabled.
- Encoded/escaped entities in email notifications.
- German translation issue.

## [1.4.1.2] - 2017-10-03
### Fixed
- New CSV separator filter introduced 1.4.1 not correctly running.

## [1.4.1.1] - 2017-09-29
### Changed
- Improved the loading order of javascript files for forms builder.
- Update some strings for Russian translation.

### Fixed
- Entries export functionality was broken.
- Multi-page indicators behavior when several multi-page forms present on the same page.

## [1.4.1] - 2017-09-28
### Added
- Ability to rename Form >Settings>Notifications>Single notification panels.
- Define a minimum PHP version support in plugin readme.txt file.
- Display a friendly link to a full page version, when form is previewed on AMP pages.
- Ability to collapse Form>Settings>Notifications>Single notification panels.
- Russian translation.
- Allow more than 1 default selection for checkboxes fields.
- Announcement feed.

### Changed
- Bump minimum WordPress version to 4.6.
- Improved localization support of the plugin.
- Improved texts in various places.
- Code style improvements throughout the plugin.
- Combine WPFORMS_DEBUG and WPFORMS_DEVELOPMENT into one, use `wpforms_debug()` to check.
- All HTTP requests now validate target sites SSL certificates with WP bundled certificates (since 3.7).

### Fixed
- Payments and providers classes version visibility.
- Postal field (part of Address field) now supports the {query_var} smart tag.
- Form's Entries page unread/read and starred/unstarred counters.
- Incomplete selection of Date dropdown fields causes entries to be recorded as 'Array'.
- Notification email is empty if submitted form has no user values (displaying user friendly message instead).
- Pressing enter in "Enter a notification name" popup does nothing.
- Removed Screen Options on single entry screen.
- Allow postal code to be hidden/removed, fix Country issues.
- Country names don't have redundant `)` or spaces anymore.
- Do not display 2400 option in TimePicker in Date / Time field for 24h format.
- Deprecate a misspelled `wpforms_csv_export_seperator` filter, introduced a proper name for it.
- Conditional logic comparison issues if rule contained special characters.

## [1.4.0.1] - 2017-08-24
### Added
- Non-dismissible Dashboard page admin only notice about PHP 5.2.

### Changed
- Updated FontAwesome library.

### Fixed
- Fatal error with PHP 5.2 due to an anonymous function.
- Required Credit Card fields incorrectly passing JS validation if empty.
- CSV exports missing line breaks.
- Entries dropdown menu being cut off under the WordPress menu.

## [1.4.0] - 2017-08-21
### Added
- Entries table columns can now be customized; personalize what fields you want to see!
- All entries can be deleted for a form from the Entries page.
- Announcement feed.

### Changed
- Phone number field switched to `tel` input for improved mobile experience.
- Core form templates are now displayed separate in the form builder from other custom templates.
- Refactored CSV exporting for better support.

### Fixed
- Dynamic Choices large items modal render issue.
- Certain characters (such as comma) breaking CSV export format.
- Cursor issues inside the form builder.
- CSS Layout Generator class name typo.
- Dynamic choices with nesting sometimes causing form builder to time out.
- Settings page typos.
- Deleting a form in some cases did not remove entry meta for its entries.
- File Uploads stored in the media library not storing the correct URL when offloaded to other services such as S3.
- Tools page export description text typo.
- Widget state not displayed correctly when adding via Customizer, without forcing user to select a form.

## [1.3.9.2] - 2017-08-03
### Fixed
- Currency setting for new users saving to an incorrect option key.

## [1.3.9.1] - 2017-08-02
### Changed
- Template Export excludes array items with empty strings.

### Fixed
- Admin notices displaying on plugin Welcome/activation screen.
- WPForms admin pages displaying blank due to conflicts with a few other plugins.
- License related notices not removed immediately after key is activated.
- Addons page items not displaying with uniform height.
- Addons page installing returned JS object instead of message.

## [1.3.9] - 2017-08-01
### Added
- Complete redesign and refactor of admin area.
- New Settings API.
- Entry print preview compact mode.
- Entry print preview view entry notes.
- Dynamic field choices nest hierarchical items.

### Changed
- Moved Import/Export and System Info content to new Tools sub-page.
- Shortcode provided in form builder now includes title/description arguments.
- Don't show CSS layout selector helper in Pagebreak fields.

### Fixed
- Form builder URL redirect issue on the Marketing tab with some configurations.
- Password field item mislabeled.
- PHP notices on Entries page if form contained no fields.
- PHP notices when using HTML field with conditional logic.

## [1.3.8] - 2017-06-13
### Added
- Conditional logic functionality is now in the core plugin - the Conditional Logic addon can be removed.
- New conditional logic rules: empty and not empty.
- Conditional logic can now be applied to fields that are marked as required.

### Changed
- Available conditional logic rules/functionality with Providers have been updated.
- Updated form builder modals (jquery-confirm.js).
- Many Form Builder performance enhancements.

### Fixed
- Allowing Storing entries form setting to be enabled when form is connected to payments.
- Number field validation message not saving.
- Email/Password confirmation setting not displaying correctly with Small field size.

## [1.3.7.3] - 2017-05-12
### Fixed
- Required setting checkbox getting out of sync when duplicating fields.
- CSS class name typo in the form builder layout selector.
- Excel mangling non-english characters when opening CSV export files.
- Smart Tag `field_id` stripping line breaks.
- Multiple Items field choices not updating correctly in form builder preview.
- Form JS settings `wpforms_settings` missing due to some caching plugins.
- Empty classes causing `array` string to be printed in some use cases.

### Changed
- Updated credit card, page break, password, and phone fields to improved field class.

## [1.3.7.2] - 2017-04-26
### Fixed
- PHP warning when displaying page break indicator at the top of a form.
- Error for some users with PHP 5.4 and below.

## [1.3.7.1] - 2017-04-26
### Fixed
- Issue sending form notifications using email fields that had confirmation enabled.

## [1.3.7] - 2017-04-26
### Added
- Google Invisible reCAPTCHA support.
- Custom field validation messages (see WPForms Settings page).
- Bulk add choices for Checkbox, Multiple Choice, and Dropdown fields.
- Filter to allow email notifications to include empty fields, `wpforms_email_display_empty_fields`.
- Custom form template exporting.
- Field CSS layout selector.
- Total payment fields can now be marked as required, preventing the field from submitting unless it contains a payment.

### Changed
- HTML fields now allow and run WordPress shortcodes.
- Leverage `wp_json_encode` instead of native PHP function.
- Various WordPress coding standard improvements (work in progress).
- Refactored form front-end code to allow for more customizations.
- Refactored text, textarea, email, number, name, divider, file upload, hidden, html, payment total, and URL fields to allow for more customizations (more coming next release).

### Fixed
- Welcome page typo.
- Address field options getting off sync inside form builder.
- Bug adding new notifications and element IDs not updating.
- Page indicator (navigation) overflowing in some use cases.
- SmartTag selectors getting off sync inside form builder.
- File upload routine using `pathinfo` which is not reliable with some locales.

## [1.3.6] - 2017-03-09
### Added
- Constant Contact integration.

### Changed
- Don't strip tags from plain text emails.

### Fixed
- Address field variable name typo.
- Form builder javascript conflict with Clef plugin.
- Form builder logo URL double slash.
- Form builder embed code field not being selectable.

## [1.3.5] - 2017-02-22
### Fixed
- Some browsers allowing unexpected characters inside number input fields.
- Error when resending email notifications through Single Entry page.
- Issue with Dropdown field placeholder text.
- Select few plugins loading conflicting scripts in form builder.

## [1.3.4] - 2017-02-09
### Added
- reCAPTCHA improvements; reCAPTCHA now required if turned on.

### Fixed
- Date/Time Smart Tag not using WordPress time zone settings.
- Name field defaults not processing Smart Tags.

## [1.3.3] - 2017-02-01
### Added
- Default value support in the email field.
- Related Entries metabox on single entry page.
- Various new hooks and filters for improved extensibility.

### Changed
- Payment status is now displayed in status column, indicated with money icon.
- Multi-page scroll can be customized via JS overrides, `wpform_pageScroll`.

### Fixed
- Possible errors if web host had `set_time_limit()` disabled.
- File upload failing in edge cases due to library not being loaded.
- PHP 7.1 warning message inside the form builder when using payments.

## [1.3.2] - 2017-01-17
### Added
- CSS class support for hidden fields, for easier targeting.
- New form class, `.inline-fields`, to apply single line form layout.
- Allow date and time pickers properties to be specified on a per form/field basis.

### Changed
- All Smart Tags now available for Email Subject field in form notifications.
- License checks rely on options, instead of transients, for more reliability.
- Enable date picker on mobile devices.

### Fixed
- Email addresses reporting as invalid of the domain contained capitalization.
- Error uploading MP3 files when File upload was using the media library.
- Author related Smart Tags not working in form notification fields.
- Typo on settings page related to Carbon Copy.
- Incorrect messaging/layout on plugins addon page for Basic license users.
- Date Time field date picker causing validation issues for mobile users.
- PHP 7.1 warning messages inside the form builder.

## [1.3.1.2] - 2016-12-12
### Fixed
- Plugin name to correctly indicate Lite for Lite release.

## [1.3.1.1] - 2016-12-12
### Fixed
- Error with 1.3.1 Lite release.

## [1.3.1] - 2016-12-08
### Added
- Dropdown Items payment field.
- Smart Tags for author ID, email, and name.
- Carbon Copy (CC) support for form notifications; enable in WPForms Settings.

### Changed
- Form data and fields publicly accessible in email class.

### Fixed
- Field duplication issues
- Total payment field error when only using Multiple Items payment field.
- TinyMCE "Add Form" button not opening modal with dynamic TinyMCE instances.
- Email formatting issues when using plain text formatting.
- Number field validation tripping when number submitted is zero.
- reCAPTCHA validation passing when reCAPTCHA left blank.
- Dropdown field size not reflecting in builder.
- File Upload field offering Size option but not supported (option removed).
- File uploads configured to go to the media library not working.
- Server-side file upload errors not displaying correct due to a type.

## [1.3.0.1] - 2016-11-10
### Added
- Context usage param to `wpforms_html_field_value` filter.
- New filter, `wpforms_plaintext_field_value`, for plaintext email values.

### Fixed
- Bug with date picker limiting date selection to current year.
- PHP notice when uploading non-media library files.
- Issue with form title/description being toggled with shortcode.
- Secured `target=_blank` usage.

## [1.3.0] - 2016-10-24
### Added
- Email field confirmation.
- Password field confirmation.
- Support for Visual Composer.
- Additional date field type, dropdowns.
- Field class to force elements to full-width on mobile devices, `wpforms-mobile-full`.

### Changed
- Datepicker library.
- Timepicker library.
- Placeholders are added/updated in real-time for Dropdown fields in the form builder.
- Add empty value to select element placeholders when displaying form for better markup validation.

### Fixed
- Multiple instances of reCAPTCHA on a page not correctly loading.
- Field choice defaults not restoring in form builder.
- Field alignment issues in the form builder when dragging field more than once.
- PHP fatal erroring if form notification email address provided is not valid upon sending.
- Date field Datepicker allows empty submit when marked as required.
- Compatibility issues when network activated on a Multisite install.

## [1.2.9.1] - 2016-10-07
### Fixed
- Compatibility issue with Stripe addon.

## [1.2.9] - 2016-10-04
### Added
- Individual fields can be duplicated in the form builder.

### Changed
- How data is stored for fields using Dynanic Choices.
- File Upload contents can (optionally) be stored in the WordPress media library.

### Fixed
- CSV exports not handling new lines well.
- Global assets setting causing errors in some cases.
- Writing setting ("correct invalidly nested XHTML") breaking forms containing HTML.
- Forms being displayed/included on the native WordPress Export page.
- Dynamic Choices erroring when used with Post Types.
- Form labels including blank IDs.

## [1.2.8.1] - 2016-09-19
### Fixed
- Form javascript email validation being too strict (introduced in 1.2.8).
- Provider sub-group IDs not correctly stored with connection information.

## [1.2.8] - 2016-09-15
### Added
- Dynamic choice feature for Dropdown, Multiple Choice, and Checkbox fields.

### Changed
- Loading order of templates and field classes - moved to `init`.
- Form javascript email validation requires domain TLD to pass.
- File Upload file size setting now allows non-whole numbers, eg 0.5.

### Fixed
- HTML email notification templates uses site locale text-direction.
- Javascript in the form builder conflicting with certain locales.
- Datepicker overflowing off screen on small devices.

## [1.2.7] - 2016-08-31
### Added
- Store initial plugin activation date.
- Input mask for US zip code within Address field, supports both 5 and 9 digit formats.
- Duplicate form submit protection.

### Changed
- Entry dates includes GMT offset defined in WordPress settings.
- Entry export now includes both local and GMT dates.
- Improved Address field to allow for new schemes/formats to be create and better customizations.

### Fixed
- Provider conditional logic processing when using checkbox field.
- Strip slashes from entry data before processing.
- Single Item field price not live updating inside form builder.

## [1.2.6] - 2016-08-24
### Added
- Expanded support for additional currencies.
- Display payment status and total column on entry list screen as allow sorting with these new columns.
- Display payment details on single entry screen.
- Miscellaneous internal improvements.

### Changed
- Added month/year selector to date picker for better accessibility.
- Payment validation methods.

### Fixed
- Incorrectly named variables in the front-end javascript preventing features from properly being extendable.

## [1.2.5] - 2016-08-03
### Added
- Setting for Email template background color.
- Form setting for form wrapper CSS class.

### Changed
- Multiple Payment field stores Choice label text.
- reCAPTCHA tweaks and added filter.
- Improved IP detection.

### Fixed
- Mapped select fields in builder triggering JS error.

## [1.2.4] - 2016-07-07
### Added
- Form import and exporting.
- Additional logging and error reporting.

### Changed
- Footer asset detection priority, for improved capability with other services.
- Refactored and refined front-end javascript.

### Fixed
- Restored form notification defaults for Blank template.
- Default field validation considered 0 value as empty.
- Rogue PHP notices.

## [1.2.3] - 2016-06-23
### Added
- Multiple form notifications capability.
- Form notification message setting.
- Form notification conditional logic (via add-on).
- Additional Smart Tags available inside Form Settings panels.
- Process Smart Tags inside form confirmation messages and URLs.
- Hide WPForms Preview page from WordPress dashboard.
- System Details tab to WPForms Settings, to display debug information, etc.

### Changed
- Center align text inside page break navigation buttons.
- Scroll to top most validation error when using form pagination.
- Many form builder javascript improvements.
- Improved internal logging and debugging tools.
- Don't show Page Break fields in Entry Tables.

### Fixed
- Form select inside modal window overflowing when a form exists with a long title.
- Large forms not always saving because of max_input_vars PHP setting.
- Entry Read/Unread count incorrect after AJAX toggle.
- Single Payment field failed validation if configured for user input and amount contained a comma.

## [1.2.2.1] - 2016-06-13
### Fixed
- Entry ID not always correctly passing to hooks.

## [1.2.2] - 2016-06-03
### Added
- Page Break navigation buttons now have an alignment setting.
- Page Break previous navigation button is toggleable and defaults to off.

### Changed
- Improved styling of Page Break fields in the builder.
- Choice Layouts now use flexbox instead of CSS columns for better rendering.

### Fixed
- Class name typo in a CSS column class introduced with 1.2.1.
- PHP notice on Entries page when there are no forms.

## [1.2.1] - 2016-05-30
### Added
- Drag and drop field buttons - simply drag the desired field to the form!
- Page Break progress indicator themes, with optional page titles.
- Choice Layout option for Checkboxes and Multiple Choice fields (under Advanced Options).
- Full and expanded column class/grid support.

### Changed
- Refactored Page Break field, fully backwards compatible with previous version.
- Page Break navigation buttons with without a label do not display.
- Refactored CSS column classes, previous classes are deprecated.
- Improved field and column gutter consistency.

### Fixed
- Form ending with column classes not closing correctly.
- reCAPTCHA button overlaying submit button preventing it from being clicked.

## [1.2] - 2016-05-19
### Added
- Column classes for Checkbox and Multiple choice inputs.

### Changed
- Improved file upload text format inside entry tables.

### Fixed
- Removed nonce verification.
- Issue with Address fields not processing correctly when using international format.

## [1.1.9.1] - 2016-05-06
### Fixed
- Payment calculations incorrect with large values.

## [1.1.9] - 2016-05-06
### Added
- Form preview.
- Other small misc updates.

### Changed
- reCAPTCHA settings description to include link to how-to article.
- Some fields did not have the correct (unique) CSS ID, this has been corrected, which means custom styling may need to be adjusted.
- Form notification settings hide if set to Off.

### Fixed
- Issue with submit button position when form ends with columns classes.
- PHP warnings inside the form builder.

## [1.1.8] - 2016-04-29
### Added
- "WPForm" to new-content admin bar menu item.

### Changed
- Removed "New" field name prefix.
- Moved email related settings into email settings group.

### Fixed
- Incorrect i18n strings.
- Load order causing add-on update conflicts.

## [1.1.7] - 2016-04-26
### Added
- Smart Tag for Dropdown/Multiple choice raw values, allowing for conditional email address notifications ([link].(https://wpforms.com/docs/how-to-create-conditional-form-notifications-in-wpforms/)).
- HTML/Code field Conditional Logic support.
- HTML/Code field CSS class support.
- Three column CSS field classes ([link](https://wpforms.com/docs/how-to-create-multi-column-form-layouts-in-wpforms/)).
- Support for WordPress Zero Spam plugin (https://wordpress.org/plugins/zero-spam/).

### Changed
- Checkbox/Multiple Choice fields allow certain HTML to display in choice labels.

### Fixed
- Issue when stacking fields with 2 column classes.

## [1.1.6] - 2016-04-22
### Added
- Entry starring.
- Entry read/unread tracking.
- Entry filtering by stars/read state.
- Entry notes.
- Entry exports (csv) for all entries in a form.

### Changed
- Improved entries table overview page.
- Email Header Image setting description to include recommended sizing.

### Fixed
- reCAPTCHA cutting off with full form theme.
- Debug output from wpforms.js.
- Conflict between confirmation action and filter.

## [1.1.5] - 2016-04-15
### Added
- Print entry for single entries.
- Export (CSV) for single entries.
- Resend notifications for single entries.
- Store user ID, IP address, and user agent for entries.

### Changed
- Improved single entry page (more improvements soon!).
- HTML Email template footer text appearance.

### Fixed
- Form builder textarea's not displaying full width.
- HTML emails not displaying correctly in Thunderbird.

## [1.1.4] - 2016-04-12
### Added
- Form general setting for "Submit Button CSS Class".
- Duplicate forms from the Forms Overview page (All Forms).
- Suggestion form template.

### Changed
- Improved error logging for providers, now writes to CPT error log.
- Adjusted field display inside the Form Builder to better resemble full theme.

### Fixed
- Firefox CSS issue in form base theme.
- Don't allow inserting shortcode via modal if there are no forms.
- Issue limiting Total field display amount.

## [1.1.3] - 2016-04-06
### Added
- New class that handles sending/processing emails.
- Form notification setting for "From Address", defaults to site administrator's email address.
- HTML email template for sleek emails (enabled by default, see more below).
- General setting to configure email notification format.
- General setting to optionally configure email notification header image.

### Changed
- Default email notification format is now HTML, can go back to plain text format via option on WPForms > Settings page.
- File Upload field now saves original file name.
- Empty fields are no longer included in email notifications.

### Fixed
- Various issues with File Upload field in different configurations.
- Address field saving select values when empty.
- Issue with Checkbox field when empty.

## [1.1.2] - 2016-04-01
### Added
- Form option to scroll page to form after submit, defaults on for new forms.

### Changed
- Revamped "Full" form theme to be more consistent across different themes, browsers, and devices.
- Full theme and bare theme separated.

### Fixed
- File upload required message when not set to required.

## [1.1.1] - 2016-03-29
### Fixed
- Settings page typo
- Providers issue causing AJAX to fail.

## [1.1] - 2016-03-28
### Added
- Credit Card payment field.

### Changed
- CSS updates to improve compatibility.

### Fixed
- PHP notices when saving plugin Settings.

## [1.0.9] - 2016-03-25
### Changed
- Email field defaulting to Required.

## [1.0.8] - 2016-03-24
### Fixed
- Name field setting always showing Required.
- Debug function incorrectly requiring WP_DEBUG.

## [1.0.7] - 2016-03-22
### Changed
- CSS tweaks.

### Fixed
- Issue with File Upload field returning incorrect file URL.
- Filter (wpforms_manage_cap) incorrectly named in some instances.

## [1.0.6] - 2016-03-21
### Added
- Embed button inside the Form Builder.
- Basic two column CSS class support.
- French translation.

### Changed
- Form names are no longer required, if no form name is provided the template name is used.
- Inputmask script, for better broad device support.
- Field specific assets are now conditionally loaded.
- CSS tweaks for form display.

### Fixed
- Issue with Date/Time field.
- Issue Address field preventing Country select from hiding in some configurations.
- Localization string errors.

## [1.0.5] - 2016-03-18
### Added
- Pagination for Entries table.

### Changed
- Checkboxes/Dropdown/Multiple Choice fields always show choice label value in e-mail notifications.

### Fixed
- PHP notices inside the Form Builder.
- Typo inside Form Builder tooltip.

## [1.0.4.1] - 2016-03-17
### Added
- Check for TinyMCE in the builder before triggering TinyMCE save.

### Fixed
- Sub labels showing when configured to hide.
- Forms pagination number screen setting not saving.
- Email notification setting always displaying "On".
- Entries counting in a Dashboard widget and Email Summaries (Lite version only).

## [1.0.4] - 2016-03-16
### Changed
- Improved marketing provider conditional logic.
- Addons page [Lite].

### Fixed
- Variable assignment in the builder.

## [1.0.3] - 2016-03-15
### Added
- Basic TinyMCE editor for form confirmation messages.

### Changed
- Removed form ID from form overview table, ID still visible in shortcode column.

### Fixed
- Checkbox/radio form elements alignment.
- Quotation slashes in email notification text.
- SSL verification preventing proper API calls on some servers.

## [1.0.2] - 2016-03-13
### Added
- Widget to display form.
- Function to display form, `wpforms_display( $form_id )`.

### Changed
- Default notification settings for Contact form template.
- Success message styling for full form theme.

## [1.0.1] - 2016-03-12
### Added
- "From Name" and "Reply To" Setting>Notification fields.
- Smart Tags feature to all Setting>Notification fields.

## [1.0.0] - 2016-03-11
- Initial release.
