# Stratum Files

> A self-contained, password-protected PHP file manager with a full-featured code editor, archive support, drag-and-drop uploads, and clipboard operations — all in a **single PHP file**.

<br>

![PHP](https://img.shields.io/badge/PHP-7.4%2B-8892BF?style=flat-square&logo=php&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-0057FF?style=flat-square)
![Version](https://img.shields.io/badge/Version-2.0-00875A?style=flat-square)
![No Dependencies](https://img.shields.io/badge/Dependencies-None-F0F0ED?style=flat-square&labelColor=E4E4DF&color=4A4A46)

<br>

---

## Features

| Feature | Description |
|---|---|
| 📁 **File Browser** | Grid and list views, sort by name/size/date, real-time filter search |
| ✏️ **Code Editor** | Ace Editor with syntax highlighting for 12+ languages, unsaved-changes indicator |
| ☁️ **Drag-and-drop Upload** | Multi-file upload modal with size preview before confirming |
| 📋 **Clipboard** | Copy / cut / paste files between directories via session-persisted clipboard bar |
| 🗜️ **Archive** | Compress any file or folder to `.zip`, extract archives in-place |
| 🔐 **Permissions** | Change `chmod` permissions using octal notation from the UI |
| ✅ **Multi-select** | Hold `⌘/Ctrl` to select multiple items, bulk copy / compress / delete |
| 🧭 **Path Travel** | Animated breadcrumb trail, browser history navigation (back/forward works) |
| 🔑 **Authentication** | Session-based password login, IP-pinned token |

<br>

---

## Quick Start

**1. Upload the file**

```bash
scp filemanager.php user@yourserver.com:/var/www/html/
```

**2. Change the password** (line 3)

```php
$pass = "your-secure-password-here";
```

**3. Visit in your browser**

```
https://yourdomain.com/filemanager.php
```

That's it. No Composer, no database, no config files.

<br>

---

## Requirements

- PHP **7.4+** (8.x recommended)
- `ZipArchive` extension (usually bundled)
- PHP Sessions enabled
- Write permissions on directories you want to manage

<br>

---

## Keyboard Shortcuts

| Action | Shortcut |
|---|---|
| Refresh directory | `R` |
| Open upload modal | `U` |
| Focus search filter | `/` |
| Select all items | `⌘ A` |
| Multi-select item | `⌘ Click` |
| Save file (in editor) | `⌘ S` |
| Close / Cancel anything | `Esc` |

<br>

---

## API Reference

All file operations are performed via `POST ?action=<name>`. Every response is JSON:

```json
{
  "status": "success",
  "msg":    "Listed",
  "data":   {}
}
```

| Action | POST Fields | Description |
|---|---|---|
| `list` | `path` | List folders and files in a directory |
| `read` | `target` | Return raw file content |
| `save` | `target`, `content` | Write content to a file |
| `delete` | `target` | Delete file or directory (recursive) |
| `rename` | `target`, `name` | Rename in-place |
| `create_folder` | `path`, `name` | Create a new directory |
| `create_file` | `path`, `name` | Create an empty file |
| `upload` | `path`, `files[]` | Upload one or more files |
| `zip` | `target` | Compress to `target.zip` |
| `unzip` | `target` | Extract `.zip` to parent directory |
| `chmod` | `target`, `perms` | Change permissions (octal string) |
| `copy_item` | `target` | Store in session clipboard as copy |
| `cut_item` | `target` | Store in session clipboard as cut |
| `paste_item` | `path` | Paste clipboard item to `path` |

Download is handled via a GET request: `?download=/absolute/path/to/file`

<br>

---

## Security

> **This tool is for trusted administrators only.** A logged-in user has full read/write access to every path accessible by the PHP process.

**Known limitations**

- Password stored as plaintext — no bcrypt or hashing
- No path jail — the entire server filesystem is accessible
- No CSRF tokens on AJAX actions
- `?download=` does not restrict paths to webroot

**Recommended hardening**

```apache
# .htaccess — restrict to your IP
<Files "filemanager.php">
  Require ip 203.0.113.1
</Files>
```

- Serve over **HTTPS only**
- Rename the file to something non-obvious (e.g. `mgt_4f9b2.php`)
- **Remove from the server when not actively in use**
- Set `session.gc_maxlifetime` in `php.ini` to expire sessions quickly

<br>

---

## Editor Language Support

`PHP` `JavaScript` `CSS` `HTML` `Python` `JSON` `Markdown` `SQL` `YAML` `Shell` `XML` `Plain text`

Mode is auto-detected from file extension. Powered by [Ace Editor](https://ace.c9.io/) with the `github` light theme.

<br>

---

## Changelog

### v2.0
- Complete UI overhaul to Stratum white design system
- Added grid / list view toggle
- Added multi-select with bulk actions (copy, compress, delete)
- Added sort dropdown (name, size, date)
- Animated breadcrumb path trail with browser history (`pushState`)
- Toast notification system — replaces all `alert()` calls
- Delete confirmation modal
- Upload modal with file preview before confirming
- FAB menu with sub-actions (New Folder, New File, Upload)
- Code editor: 12-language support, unsaved changes dot, line count, `⌘S` save
- Real-time filter search (no re-fetch)
- Full keyboard shortcut set

### v1.0
- Initial release — basic file manager with Tailwind CSS, Lucide icons, Ace editor, context menu, upload, zip, chmod, clipboard, and password authentication

<br>

---

## License

MIT © [envrc](https://t.me/envrc)
