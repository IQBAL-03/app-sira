# Changelog

All notable changes to SIRA project will be documented in this file.

## [1.1.0] - 2026-08-12

### ✨ Added
- **Responsive Navigation** - Hamburger menu untuk tampilan mobile dan tablet
  - Sidebar dapat dibuka/tutup dengan tombol hamburger di mobile
  - Overlay backdrop untuk menutup sidebar dengan tap di area luar
  - Animasi smooth slide-in/out untuk sidebar
  - Auto-close sidebar saat resize ke desktop
  
- **Mobile Optimizations**
  - Touch-friendly UI dengan target area yang lebih besar
  - Responsive padding dan spacing untuk berbagai ukuran layar
  - Nama user dipendekkan di layar kecil untuk menghemat ruang
  - Tanggal disembunyikan di mobile pada topbar
  
- **Enhanced Documentation**
  - README.md yang komprehensif dengan panduan instalasi lengkap
  - FEATURES.md dengan dokumentasi fitur dan technical details
  - CHANGELOG.md untuk tracking perubahan aplikasi

### 🎨 Changed
- **Layout Improvements**
  - Sidebar menggunakan fixed position di mobile, static di desktop
  - Topbar menjadi sticky untuk akses navigasi yang lebih mudah
  - Padding konten disesuaikan: mobile (16px), tablet (24px), desktop (32px)
  
- **Alpine.js Integration**
  - Tambahan logic untuk prevent body scroll saat sidebar terbuka di mobile
  - Auto-close sidebar functionality saat window resize
  - Improved state management untuk sidebar toggle

### 🐛 Fixed
- Body scroll issue saat sidebar terbuka di mobile
- Sidebar width consistency across different screen sizes
- Z-index layering untuk sidebar dan overlay

### 🎯 Technical Details

#### Files Modified:
- `resources/views/layouts/app.blade.php` - Added Alpine.js x-data for sidebar state
- `resources/views/layouts/sidebar.blade.php` - Added mobile overlay and responsive classes
- `resources/views/layouts/topbar.blade.php` - Added hamburger button and responsive styling
- `resources/css/app.css` - Added custom CSS for smooth transitions
- `resources/js/app.js` - Enhanced Alpine.js logic for better UX
- `README.md` - Complete rewrite with SIRA-specific documentation
- `FEATURES.md` - New file with comprehensive feature documentation
- `CHANGELOG.md` - New file for version tracking

#### Responsive Breakpoints:
- Mobile: < 640px
- Tablet: 640px - 1023px  
- Desktop: ≥ 1024px

#### Browser Support:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

---

## [1.0.0] - 2026-08-08

### 🎉 Initial Release

#### Core Features:
- ✅ User Authentication (Login, Register, Email Verification)
- ✅ Role-based Access Control (Admin & Warga)
- ✅ Dashboard for Admin and Warga
- ✅ Warga Management (CRUD)
- ✅ Letter Request System
- ✅ Complaint Management
- ✅ Monthly Dues Tracking

#### Technology Stack:
- Laravel 11.x
- PHP 8.2+
- TailwindCSS 3.x
- Alpine.js 3.x
- SQLite Database
- Vite Build Tool

#### Authentication Features:
- Laravel Breeze integration
- Email verification system
- Password reset functionality
- Remember me functionality
- Profile management

#### Admin Features:
- Dashboard with statistics
- Manage warga data
- Approve/reject letter requests
- Handle complaints
- Monitor monthly dues

#### Warga Features:
- Personal dashboard
- Submit letter requests
- File complaints
- View and pay dues
- Profile management

---

## Version Numbering

This project follows [Semantic Versioning](https://semver.org/):
- **MAJOR** version for incompatible API changes
- **MINOR** version for new functionality in a backward compatible manner
- **PATCH** version for backward compatible bug fixes

## Types of Changes
- `Added` for new features
- `Changed` for changes in existing functionality
- `Deprecated` for soon-to-be removed features
- `Removed` for now removed features
- `Fixed` for any bug fixes
- `Security` for vulnerability fixes
