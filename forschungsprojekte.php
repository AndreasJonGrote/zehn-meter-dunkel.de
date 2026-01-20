<?php include 'library/config.php'; ?>

<!DOCTYPE html>
<html lang="de">
  <head>

    <?php include 'library/head.php'; ?>

    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
  </head>
  <body class="bg-light">
      
    <?php include 'library/header.php'; ?>

    <picture class="absolute top-[20%] left-12 w-[35%] max-w-[400px] parallax-item-[0.4]">
      <source srcset="<?php the_url() ; ?>/assets/atlas-der-unsicherheit_e-roller.webp" type="image/webp">
      <img src="<?php the_url() ; ?>/assets/atlas-der-unsicherheit_e-roller.jpg" alt="Atlas der (Un-)Sicherheit" class="w-full h-auto mb-3" loading="lazy" decoding="async">
    </picture>

    <section class="text-light mix-blend-difference">
      <div class="container-fluid mt-40">
        <div class="grid grid-cols-12 relative parallax-item-[0.2]">
          <div class="col-span-4 col-start-3 font-medium text-lg font-body">
            <h2 class="text-2xl font-heading uppercase">Forschungsprojekte</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="text-light mix-blend-difference">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center parallax-item-[-0.1]">
          <div class="col-span-6 col-start-7 font-medium text-md font-body">
            <p class="">
              Zwischen dem, was Menschen im öffentlichen Raum erleben, und dem, was darüber zirkuliert, 
              liegt ein Spannungsfeld, das den wissenschaftlichen Rahmen dieser Arbeit bildet: Erfahrung 
              wird erinnert, erzählt und zur Strategie; zugleich werden Szenarien sprachlich verfügbar – 
              als Warnung, Verdichtung, Bild im Kopf. Im übergeordneten Projekt <span class="italic">ZEHN METER DUNKEL</span> wird 
              dieses Zusammenspiel als Ausgangspunkt gesetzt, um urbane (Un-)Sicherheit nicht zu dramatisieren, 
              sondern in ihren Bedingungen lesbar zu machen. Dadurch wird nachvollziehbar, warum Unsicherheit oft 
              nicht erst im Moment der Begegnung wirksam wird, sondern schon davor: als Erwartung, die Wege, 
              Blicke und Entscheidungen mitsteuert.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="text-light mix-blend-difference">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center parallax-item-[-0.2]">
          <div class="col-span-6 col-start-2 font-medium text-md font-body">
            <p class="mb-5">
              Zwei Forschungsprojekte tragen diese Perspektive. In der <a href="https://www.xjonx.com/heimweg-umfrage">Heimweg-Umfrage</a> 
              wurden bundesweit Erfahrungsberichte gesammelt und statistische Angaben mit offenen Antworten verbunden, sodass Angsträume, Vermeidungsverhalten 
              und erlebte Vorfälle nicht nur gezählt, sondern in ihrer Sprache sichtbar werden. Das <a href="https://www.xjonx.com/ceres-projekt">Ceres-Projekt</a> 
              untersucht Lokalzeitungs-Schlagzeilen: Ein mehrjähriger Korpus wird fortlaufend erweitert; ein Auswertungsalgorithmus filtert und gewichtet gewaltbezogene Formulierungen, 
              um Muster der Zuspitzung, Wiederholung und Intensität in der Berichterstattung herauszuarbeiten. Beide Projekte bilden damit den zentralen empirischen Kern, an dem sich 
              die methodische Vertiefung und die Reflexion etablierter Ansätze ausrichten – als Versuch, die Stadt weniger zu alarmieren als lesbar zu machen.
            </p>
          </div>
        </div>
        <div class="grid grid-cols-12 h-full relative items-center parallax-item-[-0.3] mt-10">
          <div class="col-span-6 col-start-9 font-medium text-md font-body">
            <p><a href="<?php the_url() ; ?>/heimweg-umfrage/" class="text-sm font-heading uppercase">Zur Heimweg-Umfrage</a></p>
            <p><a href="<?php the_url() ; ?>/ceres-projekt/" class="text-sm font-heading uppercase">Zum Ceres-Projekt</a></p>
          </div>
        </div>
      </div>
    </section>

    <?php include 'library/footer.php'; ?>

  </body>
</html>