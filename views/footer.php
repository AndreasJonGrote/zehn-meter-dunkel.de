
<footer class="bg-grey">
    <div class="container-fluid">
        <div class="grid grid-cols-12 gap-5 text-light text-xs">
            <div class="col-span-4 col-start-2">
                <h3 class="font-heading text-light/80 uppercase mb-3">ZEHN METER DUNKEL</h3>
                <p class="font-heading hyphens-auto">
                    Die Masterarbeit von <a href="https://www.xjonx.com" target="_blank">Andreas Jon Grote</a> wurde in der Fachrichtung Fotografie und Medienkunst an der <a href="https://www.hsbi.de" target="_blank">Hochschule Bielefeld</a> (HSBI) realisiert.
                    Die Arbeit wurde in den Jahren 2023 bis 2026 von <a href="https://www.hsbi.de/gestaltung/ueber-uns/personenverzeichnis/kirsten-wagner" target="_blank">Prof. Dr. Kirsten Wagner</a> und <a href="https://www.hsbi.de/gestaltung/ueber-uns/personenverzeichnis/adrian-sauer" target="_blank">Prof. Adrian Sauer</a> betreut.
                    Das Projekt umfasst eine multimediale <a href="index.php#ausstellung" target="_blank">künstlerisch-forschende Auseinandersetzung</a>, <a href="masterthesis.php" target="_blank">theoretische Reflexionen</a>, eine empirische <a href="forschungsprojekte.php#umfrage" target="_blank">Online-Umfrage</a> sowie ein medientheoretisches <a href="forschungsprojekte.php#ceres" target="_blank">Forschungsprojekt</a>.
                    <?php if (time() > date('Y-m-d', strtotime('2026-01-29 10:45:00'))) { ?>
                      Der Hochschulabschluss erfolgte am 29.01.2026 – das Forschungsprojekt wird darüber hinaus fortgeführt.
                    <?php } ?>
                </p>
            </div>
            <div class="col-span-2 col-start-8">
                <h3 class="font-heading text-light/50 uppercase mb-3">&nbsp;</h3>
                <ul class="flex flex-col gap-2">
                    <li><a href="index.php#ausstellung" class="font-heading uppercase">Ausstellung</a></li>
                    <li><a href="masterthesis.php" class="font-heading uppercase">Masterthesis</a></li>
                    <li><a href="forschungsprojekte.php" class="font-heading uppercase">Forschungsprojekte</a></li>
                </ul>
            </div>
            <div class="col-span-1 col-start-10">
                <h3 class="font-heading text-light/50 uppercase mb-3">&nbsp;</h3>
                <ul class="flex flex-col gap-2">
                    <li><a href="#top" class="font-heading uppercase">Kontakt</a></li>
                    <li><a href="#top" class="font-heading uppercase">Impressum</a></li>
                    <li><a href="#top" class="font-heading uppercase">Datenschutz</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script type="module" src="./dist/js/main.js?v=<?php echo time(); ?>"></script>