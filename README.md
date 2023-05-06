# Centralized. Regional. Attendance. Program

## What is this program
C.R.A.P. is a highly efficient and localized scheduling program designed to cater to the needs of businesses and organizations of all sizes. Our program is not only user-friendly, but also incredibly lightweight, secure, and affordable. At Salsa, we understand the importance of a reliable scheduling system, and our program is designed to deliver on that promise while also providing an exceptional user experience. Our cutting-edge technology ensures that your data is always secure, while our streamlined design guarantees a hassle-free experience for both you and your team. With C.R.A.P., scheduling has never been easier or more accessible.

## Features

- Login and Registration
  - Anyone can register: Anyone who visits your website can create an account by providing their details such as name, email, phone, and password.
  - Each user needs to be approved first by an admin or manager
  - Information is saved in a database and is secure: The user details such as name, email phone, and password will be saved in a database
        - Passwords are hashed: To ensure the security of the users' passwords, they will be hashed, which means that the password will be encrypted and cannot be decrypted.
    - if not logged in the user will be redirected to the login page
- Scheduling
  - Creating shifts: On the Manager page you can add shifts for the various roles you have on your team
    - When adding shifts you have:
      - start time
      - end time 
      - max employees
      - employee role
    - Users can select these shifts and will not show up if filled up
  - Custom shifts: sometimes Users cant work the provided shifts, they can send a custom shift that would work in their time frame.

  - The home page is where Users enter their schedules: Users can select the provided shifts and enter any special shifts or messages.
    - Special requests and messages: Users will also be able to enter any special requests or messages in a separate section on the home page.
  - The schedule is sent to the admin page and scheduling page: Once the user submits their schedule, it will be sent to the admin page for reference and the scheduling page for approval.
  - After the user's schedule is approved, it will be posted on the schedule page: Once the user's schedule is approved by the admin or manager, it will be posted on the schedule page, which can be viewed by any user of the system.
  - Managers and admins can edit the schedule after approval: If there are any changes to the schedule, managers and admins will be able to edit it accordingly.
- User management:
  - In the settings page, you can edit your account and any others: Users will be able to edit their account information as well as other users' information from the settings page.
    - Edit any user's information other than password: Users will be able to edit any user's information, except for their password.
    - Add a new user without having them register: Managers and admins will be able to create new users without having them go through the registration process.
    - Create a new role with description and permissions: Managers and admins will be able to create new roles with descriptions and permissions. This can include roles such as Admin, Manager, and User.

## Pricing

One line = $0.10 \
Current work price = $329.50

``` bash
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
PHP                             32            438            162           2498
CSS                             11            110             43            608
SQL                              2             72            148            189
-------------------------------------------------------------------------------
SUM:                            45            620            353           3295
-------------------------------------------------------------------------------
```
Current retial price: 400$ + 50$ a year to renew subscription

## Install
Installation of c.r.a.p will be used with a docker image that is deployed once registered, it will include a license file and config file(in case the system doesn't work)

## TODO

1. Retain schedule: after every week the current schedule will be flushed and copied into an archive to be able to look at it on the site
2. allow managers to edit already confirmed schedules after sent to the main
3. allow Users to change their schedules after sending it (includes calling off(need to make sure its 48 hours before the shift))
