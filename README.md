# Centralized. Regional. Attendence. Program

## What is this program



C.R.A.P is a highly efficient and localized scheduling program designed to cater to the needs of businesses and organizations of all sizes. Our program is not only user-friendly, but also incredibly lightweight, secure, and affordable. At Salsa, we understand the importance of a reliable scheduling system, and our program is designed to deliver on that promise while also providing an exceptional user experience. Our cutting-edge technology ensures that your data is always secure, while our streamlined design guarantees a hassle-free experience for both you and your team. With C.R.A.P, scheduling has never been easier or more accessible.

## Features

- Login and Registration
  - Anyone can register: Anyone who visits your website can create an account by providing their details such as name, email phone, and password.
  - Each user needs to be approved first by an admin or manager: Once a user registers, their account will not be immediately active. It will need to be approved by an admin or manager before they can log in.
  - Information is saved in a database: The user details such as name, email phone, and password will be saved in a database.
        - Passwords are hashed: To ensure the security of the users' passwords, they will be hashed, which means that the password will be encrypted and stored in the database.
    - if not logged in the user will be redirected to the login page
- Scheduling
  - The home page is where you enter your schedule: Users will be able to enter their availability and wanted days on the home page.
    - One for availability and one for wanted days: There will be separate sections for availability and wanted days, so users can enter their schedules accordingly.
    - Special requests and messages: Users will also be able to enter any special requests or messages in a separate section on the home page.
  - The schedule is sent to the admin page and scheduling page: Once the user submits their schedule, it will be sent to the admin page for reference and the scheduling page for approval.
  - After the user's schedule is approved, it will be posted on the schedule page: Once the user's schedule is approved by the admin or manager, it will be posted on the schedule page, which can be viewed by any user of the system.
  - Managers and admins can edit the schedule after approval: If there are any changes to the schedule, managers and admins will be able to edit it accordingly.
- User management:
  - In the settings page, you can edit your account and any others: Users will be able to edit their account information as well as other user's information from the settings page.
    - Edit any user's information other than password: Users will be able to edit any user's information, except for their password.
    - Add a new user without having them register: Managers and admins will be able to create new users without having them go through the registration process.
    - Create a new role with description and permissions: Managers and admins will be able to create new roles with descriptions and permissions. This can include roles such as Admin, Manager, and User.

## Pricing

One line = $0.10
Current price = $304.60

``` bash
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
PHP                             30            355            132           2229
CSS                             11             90             56            590
SQL                              3             60            112            179
Markdown                         1             14              0             14
-------------------------------------------------------------------------------
SUM:                            45            519            300           3012
-------------------------------------------------------------------------------
```

## Conditions

If hosted on my own hardware you owe 5 dollars a month for up keep

Feature requests are always welcome as i want to make it to your needs but going back
to the same deal with buying the software, however many lines of code it takes to implament it
is how much it will cost, i can give a estimate of how much it will cost (avg is probally no more than a dollar)

If you decide to host the software on your own hardware, then you will no longer have to pay 5 dollar up keep.

but in order to have the software running with everything you need you would have to install all the required software and set it up properly, i can do it for $100.00 per server

## TODO

1. Retain schedule: after every week the current sched will be flushed and copied into a archive and to be able to look at it in the site
2. allow managers to edit already confirmed schedules after sent to the main
3. allow empolyes to change there schedules after sending it (includes calling off(need to make sure its 48 hours before shift))
