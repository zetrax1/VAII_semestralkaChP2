<?php


session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   // header("location: login.php");

   $isLogged = false;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nové Bývanie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed|Ubuntu:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
    <link rel="shortcut icon" type="image/png" href="images/wow.jpeg"/>
</head>
<body>
<header class="header-sticky">
    <nav class="navbar navbar-expand-lg background-color-white">
        <div class="container">
            <a class="navbar-brand main-text-color" href="#project">Nové Bývanie</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Skryť/otvoriť navigáciu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link main-text-color" href="#project">O projekte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-text-color" href="#ponuka">Ponuka</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-text-color" href="#documents">Dokumenty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-text-color" href="#contact">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link main-text-color" href="login.php"> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<section id="hero-header" class="padding-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="hero-header-wrapper">
                    <div>
                        <p class="font-weight-bold hero-title">Nové luxusné bývanie v lone prírody 
                        </p>
                        <a href="#project" class="btn btn-primary ">Zistiť viac</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-0 hero-image-wrapper">
                <img alt="IoT zariadenia" class="hero-image" src="images/living_room2.jpg">
            </div>
        </div>
    </div>
</section>
<section id="project" class="padding-wrapper main-bg-color">
    <div class="container">
        <div class="row grey-text-color justify-content-around">
            <div class="col-8 col-sm-4  project-wrapper mb-5 pt-2 pb-2">
                <div class="grey-bg-color">
                    <img alt="Blockchain" class="project-image responsiveImages" src="images/cabin1.jpg">
                </div>
            </div>
            <div class="col-10 col-sm-6 project-wrapper-reverse mb-5">
                <div class="grey-bg-color pt-5 pb-5">
                    <div class="col-12 text-center text-uppercase font-weight-bold mb-4">
                        <h3 class="section-title">O projekte</h3>
                    </div>
                    <p class="project-description text-justify pt-1 pl-5 pr-5">Našim cieľom je vytvoriť pokojné prostredie
                         pre mladé rodiny s pohodlnou dostupnosťou občianskej vybavenosti.
                         Naskytujú sa tu nové pracovné príležitosti pre množstvo profesií.
                         Potreba skĺbiť prácu, relax a rodinu v zdravom prostredí je priorita.
                         Nové možnosti v dostupnosti dopravy a budovanie cyklotrasy umožnia pohodlnú a bezpečnú prepravu do miest</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="ponuka" class="ponuka padding-wrapper" data-aos="fade-up" data-aos-duration="500"
         data-aos-easing="ease-in-out">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h3 class="section-title text-uppercase font-weight-bold">Ponuka</h3>
            </div>
            <div class="col-12 text-center">
                <ul class="row mb-3">
                    <li class="col-12 col-sm-4 ponuka-member-wrapper">
                        <div class="mb-3">
                            <div class="ponuka-member-photo">
                                <img class="rounded-circle responsiveImages" src="images/cabin2.jpg"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="font-weight-bold ponuka-member-name">Chaty</div>
                            
                        </div>
                    </li>
                    <li class="col-12 col-sm-6 col-md-4 ponuka-member-wrapper">
                        <div class="mb-3">
                            <div class="ponuka-member-photo">
                                <img class="rounded-circle responsiveImages" src="images/kitchen2.jpg"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="font-weight-bold ponuka-member-name">Domy</div>
                        </div>
                    </li>
                    <li class="col-12 col-sm-6 col-md-4 ponuka-member-wrapper">
                        <div class="mb-3">
                            <div class="ponuka-member-photo">
                                <img class="rounded-circle responsiveImages" src="images/living_room2.jpg"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="font-weight-bold ponuka-member-name">Byty</div>
                        </div>
                    </li>
                </ul>
               
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="main-bg-color">
    <div class="container">
        <div class="row product">
            <div class="product-block">Máte záujem o nejakú nehnuteľnosť ?</div>
            <a href="login.php" class="btn btn-primary hover">Prihlásenie</a>
        </div>
    </div>
</section>
<section id="documents" class="padding-wrapper grey-bg-color">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-uppercase font-weight-bold mb-5">
                <h3 class="section-title">Dokumenty</h3>
            </div>
            <div class="col-12 col-sm-12 documents-wrapper">
                <div class="mb-5" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-out">
                    <h4 class="pb-2">Stavebné plány</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Dátum</th>
                            <th scope="col">Typ nehnutelnosti</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>30.10.2019 - 06.10.2019</td>
                            <td>
                                <a href="documents/zapisnice/1-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 1
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>07.10.2019 - 13.10.2019</td>
                            <td>
                                <a href="documents/zapisnice/2-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 2
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>14.10.2019 - 20.10.2019</td>
                            <td>
                                <a href="documents/zapisnice/3-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 3
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>21.10.2019 - 27.10.2019</td>
                            <td>
                                <a href="documents/zapisnice/4-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 4
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>28.10.2019 - 03.11.2019</td>
                            <td>
                                <a href="documents/zapisnice/5-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 5
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>04.11.2019 - 10.11.2019</td>
                            <td>
                                <a href="documents/zapisnice/6-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 6
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>11.11.2019 - 17.11.2019</td>
                            <td>
                                <a href="documents/zapisnice/7-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 7
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>18.11.2019 - 24.11.2019</td>
                            <td>
                                <a href="documents/zapisnice/8-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 8
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>25.11.2019 - 01.12.2019</td>
                            <td>
                                <a href="documents/zapisnice/9-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 9
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>02.12.2019 - 08.12.2019</td>
                            <td>
                                <a href="documents/zapisnice/10-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 10
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>28.01.2020 - 24.02.2020</td>
                            <td>
                                <a href="documents/zapisnice/11-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 11
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>24.02.2020 - 01.03.2020</td>
                            <td>
                                <a href="documents/zapisnice/12-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 12
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>02.03.2020 - 08.03.2020</td>
                            <td>
                                <a href="documents/zapisnice/13-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 13
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>18.03.2020 - 01.04.2020</td>
                            <td>
                                <a href="documents/zapisnice/14-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 14
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>02.04.2020 - 06.05.2020</td>
                            <td>
                                <a href="documents/zapisnice/15-zapisnica.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    Zápisnica 15
                                </a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                
                <div class="mb-5" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-out">
                    <h4 class="pb-2">Míľniky</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Dátum</th>
                            <th scope="col">Názov</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>22.11.2019</td>
                            <td>
                                <a href="documents/doc.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    1. Míľnik: záhájenie výstavby
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>13.12.2019</td>
                            <td>
                                <a href="documents/doc.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    2. Míľnik: výstavba
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>15.05.2020</td>
                            <td>
                                <a href="documents/doc.pdf" target="_blank">
                                    <i class="fa fa-download mr-2"></i>
                                    3. Míľnik: kolaudácia
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<footer id="contact" class="main-bg-color pt-4 pb-4">
    <h4 class="text-center mb-3">Kontaktujte nás: <a class="white-text-color">novebyvanie@gmail.com</a>
    </h4>
    <h4 class="text-center">Prídite k nám na pobočku v Žiline</h4>
</footer>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
