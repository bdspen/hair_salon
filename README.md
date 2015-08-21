# Hair Salon Helper (unfinished)

##### An application that allows a salon owner to make a list of their stylists and clients
##### 08/21/2015

#### By _**Ben Spenard**_

## Description

At this point the application is unfinished. However some functionality is present.
A user can add a hair stylist to a list and then add clients that are specific to that
hair stylist.

## Setup


## Technologies Used

PHP, TWIG, SILEX and MYSQL were all used to create this project.

### Legal

*{This is boilerplate legal language. Read through it, and if you like it, use it. There are other license agreements online, but you can generally copy and paste this.}*

Copyright (c) 2015 **Ben Spenard**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

### my sql commands:

mysql> CREATE DATABASE hair_salon;

mysql> CREATE DATABASE hair_salon_test

mysql> USE hair_salon

mysql> CREATE TABLE stylist (stylist_name VARCHAR (255), id INT AUTO_INCREMENT, PRIMARY KEY (id));

mysql> create table client (client_name VARCHAR (255), id INT AUTO_INCREMENT, PRIMARY KEY (id));

mysql> use hair_salon_test;

mysql> CREATE TABLE stylist_test (stylist_name VARCHAR (255), id INT AUTO_INCREMENT, PRIMARY KEY (id));


mysql> create table client_test (client_name VARCHAR (255), id INT AUTO_INCREMENT, PRIMARY KEY (id));

mysql> use hair_salon

mysql> alter table client add stylist_id INT;

mysql> use hair_salon_test

mysql> alter table client add stylist_id INT;
