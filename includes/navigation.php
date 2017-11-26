<nav id="nav">
			<ul>
				<li class="nav1">
					<?php
						if($_SESSION['usertype']==1 || $_SESSION['usertype']==2 || $_SESSION['usertype']==4)
						{
					?>
					 <a href="zeiten_erfassen.php">Zeiten erfassen</a>
					<?php
						}
						else
						{
					?>
					<a href="#">Zeiten erfassen</a>
					<?php
						}
					?>
				</li>
			
				<li class="nav2">
					<a href="#">Auswertungen</a>
					<?php
						if($_SESSION['usertype']==1 || $_SESSION['usertype']==2 || $_SESSION['usertype']==5)
						{
					?>
					<ul>
						<li><a href="startliste_exportieren.php">Startliste pro Kategorie</a></li>
						<li><a href="startliste_alphabetisch_exportieren_fpdf.php">Startliste alphabetisch</a></li>
						<li><a href="rangliste_exportieren.php">Rangliste pro Kategorie</a></li>
						<li><a href="rangliste_finallaeufer_exportieren.php">Rangliste nur Finalläufer</a></li>
                        <li><a href="overall_rangliste.php">Rangliste über 80m</a></li>
						<li><a href="andenkkarte_generieren.php">Andenkkarten generieren</a></li>
                        <li><a href="zeitenliste_exportieren.php">Zeitenliste generieren</a></li>
					</ul>
					<?php
					}
					?>
				</li>
				
				<li class="nav3">
					<a href="#">Administration</a>
					<?php
						if($_SESSION['usertype']==1 || $_SESSION['usertype']==2 || $_SESSION['usertype']==3)
						{
					?>
					<ul>
						<li><a href="#">Anlassverwaltung</a>
							<ul>
								<li><a href="neuer_anlass.php">Neuer Anlass</a></li>
								<li><a href="anlass_bearbeiten.php">Anlass bearbeiten</a></li>
							</ul>
						</li>
						<li><a href="#">Kategorieverwaltung</a>
							<ul>
								<li><a href="neue_kategorie.php">Neue Kategorie</a></li>
								<li><a href="kategorie_bearbeiten.php">Kategorie bearbeiten</a></li>
							</ul>
						</li>
						<li><a href="#">Lehrpersonenverwaltung</a>
							<ul>
								<li><a href="neue_lehrperson.php">Neue Lehrperson</a></li>
								<li><a href="lehrperson_bearbeiten.php">Lehrperson bearbeiten</a></li>
							</ul>
						</li>
						<li><a href="#">Klassenverwaltung</a>
							<ul>
								<li><a href="neue_klasse.php">Neue Klasse</a></li>
								<li><a href="klasse_bearbeiten.php">Klasse bearbeiten</a></li>
							</ul>
						</li>
						<li><a href="#">Teilnehmerverwaltung</a>
							<ul>
								<li><a href="teilnehmeransicht.php">Teilnehmeransicht</a></li>
								<li><a href="neuer_teilnehmer.php">Neuer Teilnehmer</a></li>
								<li><a href="neue_nachanmeldung.php">Neue Nachanmeldung / Neuer Plauschteilnehmer</a></li>
								<li><a href="teilnehmer_bearbeiten.php">Teilnehmer bearbeiten</a></li>
							</ul>
						</li>
						<?php
						if($_SESSION['usertype']==1)
						{
						?>
						<li><a href="#">Benutzerverwaltung</a>
							<ul>
								<li><a href="neuer_benutzer.php">Neuer Benutzer</a></li>
								<li><a href="benutzer_bearbeiten.php">Benutzer bearbeiten</a></li>
							</ul>
						</li>
						<?php
						}
						?>
					</ul>
					<?php
					}
                    else if($_SESSION['usertype']==5)
                    {
                       ?>
                        <ul>
                            <li><a href="#">Teilnehmerverwaltung</a>
							<ul>
								<li><a href="teilnehmeransicht.php">Teilnehmeransicht</a></li>
							</ul>
						</li>
                        </ul>
                       <?php
                    }
					?>
				</li>
				
			</ul>
		</nav>