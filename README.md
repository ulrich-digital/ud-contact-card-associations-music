# UD Block: Contact Card – Associations & Music

Block zur Darstellung von Kontaktinformationen für Vereine, Musikgruppen oder ähnliche Organisationen.
Die Daten können direkt im Editor eingegeben und optional mit einem Bild oder einer Website verknüpft werden.

---

## Funktionen

- Zeigt Name, Beschreibung, Kontaktperson, Adresse, Telefon, E-Mail und Website an
- Optionales Bildfeld zur visuellen Ergänzung
- Website-Link mit individuell anpassbarem Label
- Vollständig editierbar im Gutenberg-Editor
- Serverseitiges Rendering über `render.php`
- Kompatibel mit Full Site Editing (FSE)

---


## Screenshots
![Frontend-Ansicht](./assets/ud-contact-card-associations-music.png)
*Abbildung: Frontend-Ansicht.*


![Editor-Ansicht](./assets/editor-view.png)
*Abbildung: Editor-Ansicht.*

--
## ⚙️ Attribute (Auszug)

| Attribut | Typ | Beschreibung |
|-----------|-----|--------------|
| `name` | string | Name des Vereins oder der Gruppe |
| `description` | string | Kurze Beschreibung |
| `contactPerson` | string | Kontaktperson |
| `address` | string | Adresse |
| `phone` | string | Telefonnummer |
| `email` | string | E-Mail-Adresse |
| `websiteUrl` | string | Externer Link |
| `websiteLabel` | string | Beschriftung für den Website-Link |
| `showImage` | boolean | Anzeige eines Bildes aktivieren/deaktivieren |

---

## 🪪 Lizenz

GPL v2 or later
© ulrich.digital gmbh – [https://ulrich.digital](https://ulrich.digital)
