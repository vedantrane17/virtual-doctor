# 🩺 Virtual Doctor Appointment System (Yii2)

A web application built using the Yii2 PHP framework that allows users to book appointments with doctors, doctors to manage schedules and holidays, and admins to manage users and system data.

---

## 🚀 Features

- 🧑‍💻 User Registration & Login (User, Doctor, Admin roles)
- 🩺 View and book appointments with doctors
- 📅 Doctors can manage working hours and mark holidays
- 🛠 Admin panel to manage users, doctors, and appointments
- 📧 Appointment confirmation (email file generated)
- 🔐 Role-based access control (RBAC)

---

## 📂 Folder Structure

controllers/ # Contains all controllers (SiteController, AppointmentController, etc.)
models/ # Models like User, Appointment, Doctor, etc.
views/ # View files for all pages
migrations/ # Migration files to set up database
runtime/emails/ # Generated appointment confirmation HTML files


---

## ⚙️ Installation

1. Clone or download the project
2. Install dependencies using Composer:`composer install`
3. Create a database and configure it in `config/db.php`
4. Run migrations: `php yii migrate`
5. Start the development server: `php yii serve`

6. Visit `http://localhost:8080`

---

## 👤 Default Roles

- Admin: manually add a user with `role = admin` in the DB
- Doctor: select "Doctor" role during registration
- User: select "User" role during registration

---

## 💡 Notes

- Doctors cannot be booked on their holidays
- All emails are saved as `.html` files in `runtime/emails`
- Only authenticated users can create appointments

---




