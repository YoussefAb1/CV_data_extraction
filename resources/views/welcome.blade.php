<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="{{asset('backend/assets/css/styles.css')}}" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Page HOME | DigiSyndic</title>
  </head>


  <body>
    <nav>
      <div class="nav__bar">
        <div class="nav__logo"><a href="#">DigiSyndic</a></div>
        <ul class="nav__links">
          <li class="link"><a href="#home">Principal</a></li>
          <li class="link"><a href="#about">À Propos de Nous </a></li>

          <li class="link"><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav__btns">
            <a href="{{ route('index2') }}" class="btn btn__secondary">Login</a>
        </div>
      </div>
    </nav>

    <header class="header">
      <div class="header__container">
        <div class="header__content">
          <h1>La solution complète pour une gestion de copropriété simplifiée et efficace
<br>

            </h1>
          <p>
            Avec DigiSyndic, gérez facilement tous les aspects de votre copropriété. De la gestion des finances à l'organisation des assemblées générales, notre plateforme vous offre tous les outils nécessaires pour une administration transparente et efficace.
          </p>
          <div class="header__btns">
            <a href="{{ route('index2') }}" class="btn btn__secondary">Login</a>
        </div>
        </div>
        <div class="header__image">
          <img src="{{ asset('backend/assets/images/header.png') }}" alt="header" />
        </div>
      </div>
    </header>

    <section class="section__container about__container" id="about">
      <div class="about__image">
        <img src="{{ asset('backend/assets/images/about.jpg') }}" alt="about" />
      </div>
      <div class="about__content">
        <h3>À Propos de Nous
        </h3>
        <h6 class="section__header">
             Votre confort, notre priorité
        </h6>
        <br>
        <p class="section__subheader">
            la solution innovante dédiée à la gestion de syndic de copropriété. Nous sommes passionnés par l'amélioration de la vie en copropriété en offrant des outils qui rendent la gestion simple, transparente et efficace.
        </p>
        <br><br>
        <p class="section__subheader">

            <h3>Nos Valeurs</h3>
            <br>

            <strong>Transparence</strong> : Nous offrons une visibilité totale sur la gestion de la copropriété pour tous les copropriétaires.
            <br><br>
            <strong>Innovation</strong> : Nous utilisons les technologies les plus récentes pour simplifier les tâches complexes.
            <br><br>
            <strong>Satisfaction Client</strong> : La satisfaction de nos utilisateurs est au cœur de nos préoccupations. Nous nous efforçons de fournir un support client réactif et efficace.
            <br><br>
            <strong>Fiabilité</strong> : Nous nous engageons à fournir une plateforme sécurisée et stable pour toutes vos opérations de gestion.
        </p>

        <div class="about__grid">
            <div class="about__card">
              <h4>Projets Précédents</h4>
              <p>34+</p>
            </div>
            <div class="about__card">
              <h4>Années d'Expérience</h4>
              <p>20+</p>
            </div>
            <div class="about__card">
              <h4>Projets en Cours</h4>
              <p>12</p>
            </div>
          </div>

      </div>
    </section>

    <section class="section__container contact__container" id="contact">
      <div class="contact__image">
        <img src="{{ asset('backend/assets/images/contact.jpg') }}" alt="contact" />
      </div>
      <div class="contact__content">
        <h2 class="section__header">Contacter Nous</h2>
        <br>
        <p class="section__subheader">
            Nous sommes là pour vous aider à chaque étape de la gestion de votre copropriété. Si vous avez des questions, des suggestions ou si vous avez besoin d'une assistance particulière, n'hésitez pas à nous contacter.
        </p>
        <form action="#">
          <div class="form__group">
            <input type="text" placeholder="Prénom" />
            <input type="text" placeholder="Nom" />
          </div>
          <div class="form__group">
            <input type="text" placeholder="Email " />
            <input type="text" placeholder="Téléphone" />
          </div>
          <textarea cols="30" rows="5" placeholder="Description"></textarea>
          <button style="border-radius: 3em;">ENVOYER</button>
        </form>
      </div>
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h4>DigiSyndic</h4>
          <p>
            Notre équipe est composée de professionnels expérimentés en gestion de syndic de copropriété, en finance, et en développement technologique. Nous travaillons ensemble pour offrir une expérience utilisateur optimale et pour répondre à vos attentes.
          </p>
          <div class="footer__socials">
            <span>
              <a href="#"><i class="ri-facebook-circle-fill"></i></a>
            </span>
            <span>
              <a href="#"><i class="ri-instagram-line"></i></a>
            </span>
            <span>
              <a href="#"><i class="ri-twitter-fill"></i></a>
            </span>
          </div>
        </div>
        <div class="footer__col">
          <h4>Company Info</h4>
          <a href="#home">Principal</a>
          <a href="#about">A propos de Nous</a>
          <a href="#contact">Contact</a>
        </div>
        <div class="footer__col">
          <h4>Ressources</h4>
          <a href="#">Terms</a>
          <a href="#">Conditions</a>
          <a href="#">Policy</a>
        </div>
        <div class="footer__col">
          <h4>Contact</h4>
          <a href="#">
            <span><i class="ri-mail-line"></i></span> DigiSyndic@gmail.com
          </a>
          <a href="#">
            <span><i class="ri-phone-line"></i></span> +212 522222222
          </a>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 DigiSyndic. Tout les droits sont réservés.
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{asset('backend/assets/js/main.js')}}"></script>
  </body>
</html>
