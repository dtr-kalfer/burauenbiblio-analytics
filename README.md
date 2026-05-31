# 📊 BurauenBiblio Analytics

**BurauenBiblio Analytics** is an independent research and analytics dashboard built around the BurauenBiblio library ecosystem.

Its primary purpose is to provide **visual insights, collection intelligence, circulation trends, attendance activity, and subject distribution analytics** using interactive charts powered by **Chart.js**, **PHP**, and **MySQL**.

Rather than being embedded directly into the library management system, this project serves as a **dedicated analytics layer** for research, reporting, monitoring, and future data exploration.

---

## ✨ Features

### 📚 Collection Growth Analytics

Track the library's collection expansion over time.

Displays:

* Bibliographic record growth
* Copy/item growth
* Weekly collection activity
* Month-range filtering

---

### 🔄 Circulation Analytics

Visualize borrowing and return activity across time.

Displays:

* Monthly checkouts
* Monthly check-ins
* Circulation trends
* Shared dashboard date filtering

---

### 👥 Library Attendance Analytics

Explore library usage and visitor activity.

Displays:

* Attendance by month
* Student course distribution
* Faculty / visitor activity
* Optional **Students Only** filtering

---

### 🏷️ DDC (Dewey Decimal Classification) Analytics

Analyze collection composition through Dewey Decimal subject distribution.

Displays:

* Top DDC categories
* Collection subject concentrations
* Color-coded classification groups
* Vertical bar visualization optimized for large category counts

---

## 🏗️ Architecture

BurauenBiblio Analytics follows a modular dashboard architecture:

```plaintext
Dashboard UI
    ↓
dashboard.js
    ↓
API Layer
    collection_api.php
    circulation_api.php
    attendance_api.php
    ddc_api.php
    ↓
Analytics Classes
    CollectionAnalytics
    Circ_Analytics
    Attendance
    DDCAnalytics
    ↓
MySQL Database
```

The project separates:

* **Presentation Layer (HTML/CSS/Chart.js)**
* **Dashboard Logic (JavaScript)**
* **API Layer (JSON endpoints)**
* **Analytics Classes (database logic)**

This structure improves maintainability, experimentation, and future extensibility.

---

## 📂 Project Structure

```plaintext
burauenbiblio-analytics/
├── 📙 README.md
├── 📁 api
│   ├── 📙 attendance_api.php
│   ├── 📙 circulation_api.php
│   ├── 📙 collection_api.php
│   └── 📙 ddc_api.php
├── 📁 assets
│   ├── 📁 css
│   │   └── 📙 style.css
│   └── 📁 js
│       ├── 📙 chart.js
│       ├── 📙 dashboard.js
│       ├── 📙 highcharts.js
│       ├── 📙 jquery-3.6.0.min.js
│       └── 📙 jquery.highchartTable.js
├── 📙 autoload.php
├── 📁 classes
│   ├── 📁 Circ_Analytics
│   │   └── 📙 Circ_Analytics.php
│   ├── 📙 ConnectDB.php
│   ├── 📁 DDC
│   │   └── 📙 DDCAnalytics.php
│   ├── 📁 LibraryAttendance
│   │   └── 📙 Attendance.php
│   └── 📁 LibraryCollection
│       └── 📙 CollectionAnalytics.php
├── 📁 config
│   └── 📙 dbParams.php
└── 📙 index.php
```

---

## ⚙️ Requirements

* PHP 8+
* MySQL / MariaDB
* Web Server (Apache / Nginx)
* Existing BurauenBiblio-compatible database

---

## 🚀 Installation

Clone the repository:

```bash
git clone https://github.com/dtr-kalfer/burauenbiblio-analytics.git
```

Configure database credentials:

```plaintext
config/dbParams.php
```

Point your web server to the project directory.

Open:

```plaintext
http://localhost/burauenbiblio-analytics
```

---

## 🎯 Project Goals

This project aims to support:

* Library analytics
* Collection research
* Usage monitoring
* Institutional reporting
* Data-driven library decision making
* Future forecasting / AI experimentation
* Educational analytics exploration

---

## 🔮 Future Ideas

Possible future enhancements:

* PDF / CSV export
* Heatmaps
* Trend forecasting
* Predictive circulation analytics
* Public dashboard mode
* Mobile dashboard optimization
* API integrations
* Comparative multi-library analytics

---

## 📜 License

This project follows the licensing model of its parent ecosystem (GPL-V2) where applicable.

Please retain original attribution and copyright notices when reusing or adapting related components.

---

## ❤️ Acknowledgements

Built as part of the broader **BurauenBiblio** ecosystem.

Special thanks to open-source communities, library software developers, educators, and library practitioners supporting accessible information systems and analytics.

> DDC category descriptions are adapted from [Wikipedia](https://en.wikipedia.org/wiki/List_of_Dewey_Decimal_classes) under the [CC BY-SA 4.0 License](https://creativecommons.org/licenses/by-sa/4.0/)
> [Chart.js](https://github.com/chartjs/Chart.js) – Data visualization (MIT)
