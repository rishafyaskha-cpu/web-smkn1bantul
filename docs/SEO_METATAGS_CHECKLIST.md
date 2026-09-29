# 📋 SEO META TAGS CHECKLIST
## SMK Negeri 1 Bantul Website

---

## 🎯 **1. PRIMARY META TAGS (Wajib di semua halaman)**

### **A. Basic Meta Tags**
```html
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="language" content="Indonesia" />
```

### **B. Title & Description**
```html
<title>Judul Halaman - SMK Negeri 1 Bantul</title>
<meta name="title" content="Judul Halaman - SMK Negeri 1 Bantul" />
<meta name="description" content="Deskripsi singkat halaman (150-160 karakter)" />
```

**ATURAN:**
- Title: 50-60 karakter (optimal)
- Description: 150-160 karakter (optimal)
- Include target keyword di awal title
- Unique untuk setiap halaman

### **C. Keywords**
```html
<meta name="keywords" content="smk negeri 1 bantul, smk bantul, sekolah kejuruan, pendidikan vokasi, yogyakarta" />
```

### **D. Author & Copyright**
```html
<meta name="author" content="SMK Negeri 1 Bantul" />
<meta name="copyright" content="SMK Negeri 1 Bantul" />
<meta name="publisher" content="SMK Negeri 1 Bantul" />
```

### **E. Robots & Indexing**
```html
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<meta name="googlebot" content="index, follow" />
<meta name="bingbot" content="index, follow" />
```

**OPSI LAIN:**
- `noindex, nofollow` - untuk halaman yang tidak ingin diindex
- `noarchive` - tidak boleh di-cache
- `nosnippet` - tidak tampilkan snippet di hasil pencarian

---

## 📱 **2. OPEN GRAPH TAGS (Facebook, LinkedIn, WhatsApp)**

```html
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://smkn1bantul.sch.id/halaman" />
<meta property="og:title" content="Judul Halaman - SMK Negeri 1 Bantul" />
<meta property="og:description" content="Deskripsi halaman untuk social media" />
<meta property="og:image" content="https://smkn1bantul.sch.id/images/og-image.jpg" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="SMK Negeri 1 Bantul" />
<meta property="og:site_name" content="SMK Negeri 1 Bantul" />
<meta property="og:locale" content="id_ID" />
```

**UKURAN GAMBAR OG:**
- Optimal: 1200 x 630 px
- Min: 600 x 315 px
- Format: JPG, PNG
- Max size: < 8 MB

---

## 🐦 **3. TWITTER CARD TAGS**

```html
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:url" content="https://smkn1bantul.sch.id/halaman" />
<meta name="twitter:title" content="Judul Halaman - SMK Negeri 1 Bantul" />
<meta name="twitter:description" content="Deskripsi halaman untuk Twitter" />
<meta name="twitter:image" content="https://smkn1bantul.sch.id/images/twitter-card.jpg" />
<meta name="twitter:image:alt" content="SMK Negeri 1 Bantul" />
<meta name="twitter:site" content="@smkn1bantul" />
<meta name="twitter:creator" content="@smkn1bantul" />
```

**JENIS CARD:**
- `summary` - card kecil dengan gambar
- `summary_large_image` - card besar dengan gambar
- `app` - untuk mobile app
- `player` - untuk video/audio

---

## 🔗 **4. CANONICAL & ALTERNATE**

```html
<!-- Canonical URL (hindari duplicate content) -->
<link rel="canonical" href="https://smkn1bantul.sch.id/halaman" />

<!-- Alternate language versions (jika ada) -->
<link rel="alternate" hreflang="id" href="https://smkn1bantul.sch.id/halaman" />
<link rel="alternate" hreflang="en" href="https://smkn1bantul.sch.id/en/page" />
<link rel="alternate" hreflang="x-default" href="https://smkn1bantul.sch.id/halaman" />
```

---

## 🚀 **5. PERFORMANCE & PRELOADING**

```html
<!-- DNS Prefetch -->
<link rel="dns-prefetch" href="https://www.google-analytics.com" />
<link rel="dns-prefetch" href="https://fonts.googleapis.com" />
<link rel="dns-prefetch" href="https://newsapi.org" />

<!-- Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

<!-- Preload critical resources -->
<link rel="preload" as="font" type="font/woff2" href="/fonts/geomanist.woff2" crossorigin />
<link rel="preload" as="image" href="/images/hero-image.jpg" />
<link rel="preload" as="style" href="/styles/critical.css" />
```

---

## 🏢 **6. FAVICON & APP ICONS**

```html
<!-- Standard Favicon -->
<link rel="icon" type="image/x-icon" href="/favicon.ico" />
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />

<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />

<!-- Android/Chrome -->
<link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png" />
<link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png" />

<!-- PWA Manifest -->
<link rel="manifest" href="/manifest.json" />

<!-- Theme Color -->
<meta name="theme-color" content="#0A3C86" />
<meta name="msapplication-TileColor" content="#0A3C86" />
<meta name="msapplication-config" content="/browserconfig.xml" />
```

---

## 🏗️ **7. STRUCTURED DATA (JSON-LD)**

### **A. Organization Schema**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "SMK Negeri 1 Bantul",
  "alternateName": "SMKN 1 Bantul",
  "url": "https://smkn1bantul.sch.id",
  "logo": "https://smkn1bantul.sch.id/logo.png",
  "description": "SMK Negeri 1 Bantul adalah sekolah menengah kejuruan terbaik di Bantul, Yogyakarta",
  "foundingDate": "1968-06-09",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Parangtritis No.KM.11, Dukuh, Sabdodadi",
    "addressLocality": "Bantul",
    "addressRegion": "Daerah Istimewa Yogyakarta",
    "postalCode": "55715",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-274-367156",
    "contactType": "customer service",
    "availableLanguage": ["Indonesian"]
  },
  "sameAs": [
    "https://www.facebook.com/smkn1bantul",
    "https://www.instagram.com/smkn1bantul",
    "https://twitter.com/smkn1bantul",
    "https://www.youtube.com/@smkn1bantul"
  ]
}
</script>
```

### **B. BreadcrumbList Schema**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Beranda",
      "item": "https://smkn1bantul.sch.id/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Berita",
      "item": "https://smkn1bantul.sch.id/berita"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Judul Berita",
      "item": "https://smkn1bantul.sch.id/berita/judul-berita"
    }
  ]
}
</script>
```

### **C. Article/NewsArticle Schema (untuk halaman berita)**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "Judul Berita",
  "image": [
    "https://smkn1bantul.sch.id/images/berita/image.jpg"
  ],
  "datePublished": "2025-01-15T08:00:00+07:00",
  "dateModified": "2025-01-15T09:30:00+07:00",
  "author": {
    "@type": "Organization",
    "name": "SMK Negeri 1 Bantul"
  },
  "publisher": {
    "@type": "Organization",
    "name": "SMK Negeri 1 Bantul",
    "logo": {
      "@type": "ImageObject",
      "url": "https://smkn1bantul.sch.id/logo.png"
    }
  },
  "description": "Deskripsi singkat berita"
}
</script>
```

### **D. WebPage Schema**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Judul Halaman",
  "description": "Deskripsi halaman",
  "url": "https://smkn1bantul.sch.id/halaman",
  "inLanguage": "id-ID",
  "isPartOf": {
    "@type": "WebSite",
    "name": "SMK Negeri 1 Bantul",
    "url": "https://smkn1bantul.sch.id"
  }
}
</script>
```

---

## 🎓 **8. EDUCATION-SPECIFIC META TAGS**

```html
<!-- Education specific -->
<meta name="school.type" content="Vocational High School" />
<meta name="school.level" content="Secondary Education" />
<meta name="school.country" content="Indonesia" />
<meta name="school.region" content="Yogyakarta" />
<meta name="school.accreditation" content="A" />
```

---

## 📱 **9. MOBILE & APP META TAGS**

```html
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="apple-mobile-web-app-title" content="SMKN1 Bantul" />

<!-- Android -->
<meta name="mobile-web-app-capable" content="yes" />
<meta name="application-name" content="SMKN1 Bantul" />

<!-- Microsoft -->
<meta name="msapplication-TileImage" content="/mstile-144x144.png" />
<meta name="msapplication-tap-highlight" content="no" />
```

---

## 🔒 **10. SECURITY & PRIVACY META TAGS**

```html
<!-- Security -->
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; style-src 'self' 'unsafe-inline' https:; img-src 'self' data: https:; font-src 'self' data: https:;" />
<meta http-equiv="X-Content-Type-Options" content="nosniff" />
<meta http-equiv="X-Frame-Options" content="SAMEORIGIN" />
<meta http-equiv="X-XSS-Protection" content="1; mode=block" />
<meta name="referrer" content="no-referrer-when-downgrade" />
```

---

## 📊 **11. ANALYTICS & VERIFICATION**

```html
<!-- Google Search Console Verification -->
<meta name="google-site-verification" content="your-verification-code" />

<!-- Bing Webmaster Verification -->
<meta name="msvalidate.01" content="your-verification-code" />

<!-- Pinterest Verification -->
<meta name="p:domain_verify" content="your-verification-code" />

<!-- Facebook Domain Verification -->
<meta name="facebook-domain-verification" content="your-verification-code" />
```

---

## 📄 **12. CONTOH LENGKAP PER HALAMAN**

### **A. Halaman Beranda (Home)**

```html
<!doctype html>
<html lang="id">
  <head>
    <!-- Basic Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- Primary Meta Tags -->
    <title>SMK Negeri 1 Bantul - Sekolah Menengah Kejuruan Terbaik di Bantul</title>
    <meta name="title" content="SMK Negeri 1 Bantul - Sekolah Menengah Kejuruan Terbaik di Bantul" />
    <meta name="description" content="SMK Negeri 1 Bantul adalah sekolah kejuruan unggulan di Bantul dengan program studi berkualitas, fasilitas lengkap, dan lulusan siap kerja. Daftar sekarang!" />
    <meta name="keywords" content="SMK Negeri 1 Bantul, SMKN 1 Bantul, SMK Bantul, sekolah kejuruan, pendidikan vokasi, SMK terbaik Yogyakarta, sekolah menengah kejuruan" />
    <meta name="author" content="SMK Negeri 1 Bantul" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://smkn1bantul.sch.id/" />
    <meta property="og:title" content="SMK Negeri 1 Bantul - Sekolah Menengah Kejuruan Terbaik" />
    <meta property="og:description" content="SMK Negeri 1 Bantul, sekolah kejuruan unggulan dengan program studi berkualitas dan lulusan siap kerja." />
    <meta property="og:image" content="https://smkn1bantul.sch.id/og-home.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:site_name" content="SMK Negeri 1 Bantul" />
    <meta property="og:locale" content="id_ID" />
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="https://smkn1bantul.sch.id/" />
    <meta name="twitter:title" content="SMK Negeri 1 Bantul" />
    <meta name="twitter:description" content="Sekolah kejuruan unggulan di Bantul" />
    <meta name="twitter:image" content="https://smkn1bantul.sch.id/twitter-home.jpg" />
    
    <!-- Canonical -->
    <link rel="canonical" href="https://smkn1bantul.sch.id/" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/logo.ico" />
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#0A3C86" />
    
    <!-- Preconnect -->
    <link rel="preconnect" href="https://newsapi.org" />
    <link rel="dns-prefetch" href="https://www.google.com" />
  </head>
  <body>
    <!-- Content -->
  </body>
</html>
```

---

### **B. Halaman Berita (News List)**

```html
<!-- Primary Meta Tags -->
<title>Berita Terkini - SMK Negeri 1 Bantul</title>
<meta name="title" content="Berita Terkini - SMK Negeri 1 Bantul" />
<meta name="description" content="Baca berita dan informasi terkini seputar kegiatan, prestasi, dan pengumuman dari SMK Negeri 1 Bantul." />
<meta name="keywords" content="berita smk bantul, informasi sekolah, pengumuman smkn1 bantul, kegiatan sekolah, prestasi siswa" />
<meta name="robots" content="index, follow" />

<!-- Open Graph -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://smkn1bantul.sch.id/berita" />
<meta property="og:title" content="Berita Terkini - SMK Negeri 1 Bantul" />
<meta property="og:description" content="Informasi terkini seputar kegiatan dan prestasi SMK Negeri 1 Bantul" />
<meta property="og:image" content="https://smkn1bantul.sch.id/og-berita.jpg" />

<!-- Canonical -->
<link rel="canonical" href="https://smkn1bantul.sch.id/berita" />
```

---

### **C. Halaman Detail Berita**

```html
<!-- Primary Meta Tags -->
<title>Judul Berita Spesifik - SMK Negeri 1 Bantul</title>
<meta name="title" content="Judul Berita Spesifik - SMK Negeri 1 Bantul" />
<meta name="description" content="Ringkasan singkat dari konten berita ini dalam 150-160 karakter" />
<meta name="keywords" content="keyword1, keyword2, smk bantul, berita" />
<meta name="robots" content="index, follow" />
<meta name="article:published_time" content="2025-01-15T08:00:00+07:00" />
<meta name="article:modified_time" content="2025-01-15T09:00:00+07:00" />
<meta name="article:author" content="SMK Negeri 1 Bantul" />

<!-- Open Graph -->
<meta property="og:type" content="article" />
<meta property="og:url" content="https://smkn1bantul.sch.id/berita/judul-berita" />
<meta property="og:title" content="Judul Berita Spesifik" />
<meta property="og:description" content="Ringkasan berita" />
<meta property="og:image" content="https://smkn1bantul.sch.id/images/berita/image.jpg" />
<meta property="article:published_time" content="2025-01-15T08:00:00+07:00" />
<meta property="article:section" content="Berita" />

<!-- Canonical -->
<link rel="canonical" href="https://smkn1bantul.sch.id/berita/judul-berita" />
```

---

### **D. Halaman Sejarah**

```html
<!-- Primary Meta Tags -->
<title>Sejarah SMK Negeri 1 Bantul - Perjalanan Sejak 1968</title>
<meta name="title" content="Sejarah SMK Negeri 1 Bantul - Perjalanan Sejak 1968" />
<meta name="description" content="Mengenal sejarah panjang SMK Negeri 1 Bantul sejak berdiri tahun 1968 hingga menjadi sekolah kejuruan terbaik di Bantul." />
<meta name="keywords" content="sejarah smk bantul, profil sekolah, smkn 1 bantul history, tentang smk bantul" />
<meta name="robots" content="index, follow" />

<!-- Open Graph -->
<meta property="og:type" content="article" />
<meta property="og:url" content="https://smkn1bantul.sch.id/sejarah" />
<meta property="og:title" content="Sejarah SMK Negeri 1 Bantul" />
<meta property="og:description" content="Perjalanan panjang SMK Negeri 1 Bantul sejak 1968" />
<meta property="og:image" content="https://smkn1bantul.sch.id/og-sejarah.jpg" />

<!-- Canonical -->
<link rel="canonical" href="https://smkn1bantul.sch.id/sejarah" />
```

---

### **E. Halaman Visi Misi**

```html
<!-- Primary Meta Tags -->
<title>Visi Misi SMK Negeri 1 Bantul - Mencetak Generasi Unggul</title>
<meta name="title" content="Visi Misi SMK Negeri 1 Bantul - Mencetak Generasi Unggul" />
<meta name="description" content="Visi dan misi SMK Negeri 1 Bantul dalam mencetak lulusan yang unggul, berkompeten, dan siap bersaing di dunia global." />
<meta name="keywords" content="visi misi smkn1 bantul, tujuan sekolah, nilai-nilai sekolah, profil smk bantul" />
<meta name="robots" content="index, follow" />

<!-- Open Graph -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://smkn1bantul.sch.id/visi-misi" />
<meta property="og:title" content="Visi Misi SMK Negeri 1 Bantul" />
<meta property="og:description" content="Mencetak lulusan yang unggul dan berkompeten" />
<meta property="og:image" content="https://smkn1bantul.sch.id/og-visimisi.jpg" />

<!-- Canonical -->
<link rel="canonical" href="https://smkn1bantul.sch.id/visi-misi" />
```

---

### **F. Halaman Sarana Prasarana**

```html
<!-- Primary Meta Tags -->
<title>Sarana Prasarana - Fasilitas Lengkap SMK Negeri 1 Bantul</title>
<meta name="title" content="Sarana Prasarana - Fasilitas Lengkap SMK Negeri 1 Bantul" />
<meta name="description" content="Fasilitas dan sarana prasarana lengkap di SMK Negeri 1 Bantul meliputi laboratorium, bengkel, perpustakaan, dan ruang praktik modern." />
<meta name="keywords" content="fasilitas smk bantul, laboratorium, bengkel, perpustakaan, sarana prasarana sekolah" />
<meta name="robots" content="index, follow" />

<!-- Open Graph -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://smkn1bantul.sch.id/sarana-prasarana" />
<meta property="og:title" content="Sarana Prasarana SMK Negeri 1 Bantul" />
<meta property="og:description" content="Fasilitas lengkap dan modern untuk mendukung pembelajaran" />
<meta property="og:image" content="https://smkn1bantul.sch.id/og-sarana.jpg" />

<!-- Canonical -->
<link rel="canonical" href="https://smkn1bantul.sch.id/sarana-prasarana" />
```

---

### **G. Halaman 404 Not Found**

```html
<!-- Primary Meta Tags -->
<title>Halaman Tidak Ditemukan - SMK Negeri 1 Bantul</title>
<meta name="title" content="404 - Halaman Tidak Ditemukan" />
<meta name="description" content="Halaman yang Anda cari tidak ditemukan. Kembali ke beranda SMK Negeri 1 Bantul." />
<meta name="robots" content="noindex, follow" />

<!-- No Open Graph needed for 404 -->
```

---

## ✅ **PRIORITY CHECKLIST (Implementasi Bertahap)**

### **Phase 1: Critical (Wajib) - 30 menit**
- [ ] Update `index.html` dengan basic meta tags
- [ ] Tambahkan title & description unik per halaman
- [ ] Set robots meta tag
- [ ] Tambahkan canonical URL
- [ ] Buat `robots.txt`
- [ ] Buat `sitemap.xml`

### **Phase 2: Important (High Priority) - 20 menit**
- [ ] Tambahkan Open Graph tags
- [ ] Tambahkan Twitter Card tags
- [ ] Tambahkan favicon lengkap
- [ ] Set theme-color

### **Phase 3: Enhanced (Medium Priority) - 30 menit**
- [ ] Tambahkan JSON-LD structured data
- [ ] Preconnect ke external domains
- [ ] Tambahkan breadcrumb schema
- [ ] Optimize images untuk OG

### **Phase 4: Advanced (Optional) - 40 menit**
- [ ] Tambahkan article schema untuk berita
- [ ] Setup Google Search Console
- [ ] Setup Bing Webmaster Tools
- [ ] Generate PWA manifest
- [ ] Add security headers

---

## 🔧 **TOOLS UNTUK TESTING**

1. **Google Rich Results Test**: https://search.google.com/test/rich-results
2. **Facebook Sharing Debugger**: https://developers.facebook.com/tools/debug/
3. **Twitter Card Validator**: https://cards-dev.twitter.com/validator
4. **Schema Markup Validator**: https://validator.schema.org/
5. **Google Search Console**: https://search.google.com/search-console
6. **Lighthouse (Chrome DevTools)**: Built-in browser tool
7. **Meta Tags Checker**: https://metatags.io/

---

## 📝 **NOTES**

- Semua URL harus absolute (https://domain.com/path)
- Image OG optimal: 1200x630px, < 8MB
- Title ideal: 50-60 karakter
- Description ideal: 150-160 karakter
- Update sitemap.xml setiap ada halaman baru
- Test di mobile & desktop
- Validate dengan tools di atas

---

**Last Updated**: October 17, 2025
**Version**: 1.0
