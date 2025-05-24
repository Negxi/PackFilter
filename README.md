# 🧼 PackFilter

A smart and minimalistic PocketMine-MP plugin to **filter out unwanted resource packs** (such as the infamous Chemistry Pack) that interfere with your custom textures.

---

## ✨ Features

- 🧠 Automatically removes blacklisted packs from `ResourcePackStackPacket` and `ResourcePacksInfoPacket`
- 🧱 Keeps your server's visual style consistent
- ⚙️ Configurable UUID blacklist
- 💨 Lightweight and efficient

---

## 🔧 Installation

1. Download the latest release from the [Releases](https://github.com/YourUserName/PackFilter/releases) page.
2. Drop the `.phar` file into your `plugins/` folder.
3. Start your server. A default `config.yml` will be generated automatically.

---

## 🛠️ Configuration

```yaml
blacklist:
  # Specify the UUIDs of resource packs that interfere with or override custom textures.
  # This filter prevents intrusive packs—such as the Chemistry Pack—from affecting your intended texture design.
  uuid:
    - "550e8400-e29b-41d4-a716-446655440000"

