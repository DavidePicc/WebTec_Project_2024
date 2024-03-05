DROP TABLE IF EXISTS prenotazioni;
DROP TABLE IF EXISTS utenti;
DROP TABLE IF EXISTS contatti;
DROP TABLE IF EXISTS quadri;
DROP TABLE IF EXISTS carta;

CREATE TABLE carta (
  path VARCHAR(128) NOT NULL,
  titolo VARCHAR(128) DEFAULT NULL,
  tecnica VARCHAR(128) NOT NULL,
  data SMALLINT(6) NOT NULL,
  descrizione VARCHAR(4096) NOT NULL,
  PRIMARY KEY (path)
);


INSERT INTO carta (path, titolo, tecnica, data, descrizione) VALUES
('06', NULL, 'Acquerello', 2018, 
  'L''acquerello è racchiuso in una precisa forma verticale.
  I colori giallo, rosso e azzurro risaltano sul bianco della
  carta, presente soprattutto nella parte centrale. 
  La composizione, astratta, parte dall''alto con un andamento
  lineare orizzontale, ma subisce, nella parte centrale, 
  un movimento rapido e oscillatorio dato da larghe pennellate rosse, 
  e termina in basso con un frammento obliquo, triangolare che sembra 
  alludere ad un ritorno alla staticità orizzontale della parte superiore.'),
('07', NULL, 'Acquerello', 2018, 
  'L''acquerello, quasi racchiuso in una forma rettangolare
  verticale, è attraversato da una fascia azzurra inclinata 
  con andamento ascendente, bordata da ampie macchie e
  lunghi tratti di marrone-rosso e giallo caldo, 
  vuole ricordare, anche attraverso trasparenze luminose e il
  contrasto di colori caldi e freddi, il placido corso di un fiume.'),
('10', NULL, 'Acquerello', 2018, 
  'L''acquerello, astratto, ha forma perfettamente
  rettangolare, verticale, con una dominanza di tonalità
  fredde e poco contrastate. La composizione evoca luci
  soffuse, giochi di ombre e una sensazione generale di 
  morbidezza resi dalle trasparenze e dalle sovrapposizioni
  di larghe fasce oblique, ondulate, realizzate con colori
  un po'' spenti e sfumati.'),
('14', NULL, 'Acquerello', 2018, 
  'L''acquerello, dai toni delicati e la forma irregolare, 
  presenta a sinistra un riferimento alla parte inferiore 
  di un nudo femminile realizzato con grigio payne e rosa
  chiaro. La partre destra gli fa da sfondo con tonalità 
  naturali di verde e marrone e un''ombra scura che 
  sottolinea la figura.'),
('13', NULL, 'Acquerello', 2018, 
  'L''acquerello ricopre solo in parte, in modo irregolare, 
  uno spazio rettangolare verticale. Sul bianco della carta 
  campeggiano il giallo-arancio e il grigio Payne con contrasto
  caldo/freddo e chiaro/scuro. I colori sono distribuiti in fasce di
  forma e spessore differenti, il grigio sia verticalmente che in
  modo obliquo, mentre il giallo è solo obliquo. Tutta la 
  composizione ricorda la sagoma di due trochi
  d''albero con ombre e riflessi proiettati.'),
('26', 'Autoritratto', 'Acquaforte', 1991, 
  'Questa stampa raffigura il volto frontaledell''artista 
  (nella metà destra) che passa la propria mano tra i capelli. 
  Nel lavoro è quasi del tutto assente il chiaro scuro tradizionale, 
  il volto e la mano sono raffigurati con pochi
  segni, quasi stilizzato. I capelli sono realizzati
  con una texture atipica che ricorda una sorta di corteccia.
  L''espressione è concetrata ma serena.');


CREATE TABLE quadri (
  titolo VARCHAR(128) NOT NULL,
  altezza SMALLINT(6) NOT NULL,
  larghezza SMALLINT(6) NOT NULL,
  tecnica VARCHAR(128) NOT NULL,
  data SMALLINT(6) NOT NULL,
  proprietario VARCHAR(128) DEFAULT NULL,
  path VARCHAR(255) NOT NULL,
  descrizione VARCHAR(4096) NOT NULL,
  PRIMARY KEY (titolo),
  UNIQUE KEY unique_path (path)
) ;

INSERT INTO quadri (titolo, altezza, larghezza, tecnica, data, proprietario, path, descrizione) VALUES
('Angela', 133, 83, 'Acrilico e foglia d''oro imitazione su tela', 2022, 'Collezione Privata, Padova', 'angela', 
  'Il quadro è verticale, rapporto 3:2, ed è figurativo. Rappresenta 
  in primo piano una ragazza africana a figura intera raffigurata
  a 3/4 che passeggia su una spiaggia guardando la sabbia.
  Fanno da sfondo all''orizzonte dei capanni rudimentali costruiti sulla spiaggia,
  il cielo è denso. Indossa dei gioielli (cavigliera, anello e collana) realizzati 
  con foglia d''oro. Benché sia un soggetto realistico, la tecnica utilizzata 
  rispecchia la gestione del colore che Sandra adopera nelle sue opere astratte.'),
('Chiarore', 50, 50, 'Acrilico su tela', 2023, NULL, 'chiarore', 
  'La tela, di formato quadrato, presenta una successione di fasce verticali
  irregolari di colori semi-diluiti. Da sinistra verso destra: verde scuro, 
  verde chiaro-giallastro, bianco, giallo caldo, ancora il verde acido, azzurro 
  chiarissimo, nocciola, blu-nero, blu e infine ancora blu-nero.
  In basso a sinistra un terzo circa della superficie della tela rimane 
  bianco e molto luminoso, da cui il titolo dell''opera.'),
('Cicatrici', 180, 100, 'Acrilico, garza e collage su tela', 2019, 'Collezione Privata', 'cicatrici', 
  'Questo dipinto su tela di grandi dimensioni, rettangolare verticale, è 
  realizzato con tecniche multiple: il fondo della tela è quasi totalmente
  ricoperto di stampe su carta di foto dell''artista stessa, successivamente
  sono "legate" insieme dagli interventi pittorici informali con colori 
  acrilici. Tutte le immagini e i colori distribuiti in modo quasi regolare 
  formano un tessuto e un ritmo quasi scandito. Con quest''opera l''artista 
  vuole raffigurare-esorcizzare un periodo di malattia e il cambiamento di
  percezione del tempo che questa ha determinato.'),
('Concrezioni', 60, 60, 'Acrilico e cementite su tela', 2021, 'Collezione Privata, Cremona', 'concrezioni', 
  'L''opera di formato quadrato ha un fondo di color terra di Siena bruciata. 
  I colori, (blu-nero, azzurro chiaro, bianco, giallo-arancio) sono distribuiti 
  con un andamento di fasce irregolari verticali. Nella parte centrale il colore
  è un po'' materico. Il soggetto è completamente astratto.'),
('Giovane Eroe', 180, 180, 'Acrilico su tela', 2019, 'Collezione Privata, Verona', 'giovane_eroe', 
  'Opera quadrata di grandi dimensioni, realizzata con la consueta tecnica
  dell''artista con colori diluiti e tonalità calde e fredde alternate e 
  molte zone chiare nelle quali si intravede la tela di base. 
  Fra le macchie di colore libere si intravedono parti di disegno
  anatomico ispirate al David di Michelangelo. Con questo dipinto
  l''artista vuole evocare la sensazione che si può provare di fronte 
  all''opera scultorea da ogni punto di osservazione.'),
('Islanda', 100, 100, 'Acrilico e carta di riso su tela', 2018, 'Collezione Privata, Padova', 'islanda',
  'Questa tela di formato quadrato rappresenta in modo evocativo il cratere
  di un vulcano spento situato in Islanda. La caldera del vulcano, 
  diventata un lago, riflette azzurrissima il cielo sovrastante, 
  in mezzo ad un deserto roccioso. La tecnica è mista, con acrilico 
  (blu oltre mare acceso e altre tonalità di bruno) sia denso che diluito,
  su tela con inserti di riso e sabbia.'),
('Mare Arido', 100, 100, 'Acrilico su tela', 2022, NULL, 'mare_arido', 
  'Il dipinto ha una forma esattamente quadrata, è diviso a metà da una
  linea orizzontale. Nella metà inferiore il colore dominante è il rosso 
  vivo con sfumature di marrone scuro e una zona bianca in alto a sinistra 
  vicino al taglio orizzontale. La metà superiore ha lo sfondo bianco con una
  sfumatura di rosso diluito sulla parte in basso a destra, e di marrone 
  scuro in basso a sinistra. L''opera ricorda un paesaggio surreale, 
  sanguigno, luminoso, quasi infuocato dove la staticità dell''orizzonte 
  è interrotta da due linee diagonali opposte che creano dinamismo.'),
('Pellestrina', 50, 200, 'Acrilico su quattro tele 50x50', 2012, NULL, 'pellestrina', 
  'L''opera è composta da quattro tele di formato quadrato disposte in
  sequenza orizzontale, tutte insieme formano un''immagine evocativa di una
  spiaggia dell''isola di Pellestrina. Nella parte alta di tutta la composizione, 
  una piccola striscia blu scuro/turchese rappresenta il mare, ma la maggior 
  parte dello spazio è occupato dalla sabbia, con un colore grigio caldo/beige.
  In basso a destra la figura stilizzata di un piccolo tronco abbandonato e piccole
  macchioline che raffigurano le conchiglie. L''artista vuole trasmettere il senso
  di pace e solitudine del luogo.'),
('Pioggia e Fango', 60, 120, 'Acrilico su tela', 2021, NULL, 'pioggia_e_fango', 
  'Il quadro è orizzontale, rapporto 1:2. I colori principali sono giallo 
  caldo e marrone alla base, un grigio caldo nella parte alta e una fascia
  azzurro liquido nella parte centrale. Tutti i colori hanno un andamento
  ondulato orizzontale stesi sia densi che liquidi quasi acquerellati.
  Il dipinto evoca una sorta di paesaggio realizzato con tecnica gestuale 
  espressiva non aggressiva. Molto movimento è dato da grafismi di 
  carboncino mescolati al colore liquido. '),
('Questa Ora Sono Io', 150, 150, 'Acrilico e collage su legno', 2022, 'Collezione DUdA', 'questa_ora_sono_io', 
  'Il lavoro, eseguito su legno, ha un formato quadrato di grandi dimensioni. 
  Il fondo è lavorato con inserti di collage di vecchi appunti scolastici
  dell''autrice. Si intravede in parte una figura umana realizzata come 
  disegno/studio anatomico. Compaiono inoltre altri elementi di studio
  come una composizione modulare con colori primari e alcune righe di
  esercizio calligrafico. Tutto è legato insieme da pennellate libere
  e colori caldi e freddi insieme.'),
('Respiro', 80, 80, 'Acrilico su tela', 2020, NULL, 'respiro', 
  'L''opera, realizzata nel pieno della pandemia del 2020, ha un 
  formato quadrato, ma la composizione presenta un andamento verticale
  dato dalle due fasce laterali scure, con una dominanza di blu, che
  racchiudono la parte centrale più luminosa. Questa, con tonalità
  calde di rosso, beige, terra di Siena bruciata e. in basso a destra,
  verde muschio, rappresenta idealmente una finestra aperta.'),
('Tempesta di Sabbia', 60, 40, 'Acrilico su tela', 2020, 'Collezione Privata, Padova', 'tempesta_di_sabbia', 
  'Il quadro, di piccole dimensioni, ha un formato rettangolare verticale
  suddiviso in modo irregolare in tre fasce orizzontali. La parte alta è
  di colore blu-nero sfumato verso il basso con il bianco puro, la parte
  centrale ricorda delle dune di sabbia ed è realizzata con giallo molto
  caldo sfumato in alcune zone con un rosso pompeiano, la parte più in basso 
  è composta dai colori precedenti disciolti in un grigio caldo e chiaro ed 
  è la parte di maggior riferimento al titolo.'),
('Una ferita aperta', 80, 80, 'Acrilico su tela', 2020, NULL, 'una_ferita_aperta', 
  'L''opera è di formato quadrato quasi interamente divisa in fasce di 
  diverso colore (blu, azzurro, grigio caldo chiaro, rosso vivo, marrone 
    scuro e giallo caldo) inclinate dall''alto a sinistra verso il basso 
  a destra. Dalla fascia di colore rosso si stacca una goccia di colore che scende
  verticale fino alla base del dipinto. In basso a destra le fasce diagonali 
  sono interrotte da una zona chiara, delimitata da un bordo irregolare 
  marrone scuro, che sottolinea e racchiude quell''angolo della tela.'),
('Spigolo Vivo',60,60,'Acrilico su tela', 2021, NULL, 'spigolo_vivo',
  'Sulla tela, con formato quadrato di medie dimensioni, risalta 
  un verde chiaro, giallastro e molto luminoso steso su di un fondo 
  color grafite. La composizione assume un andamento via via triangolare,
  dato da linee oblique che sembrano partire da sinistra e dal basso 
  per dare un movimento di rotazione al campo quadrato. Nel fondo 
  grafite campeggia una colatura dello stesso beige che troviamo 
  alla base del dipinto. L''angolo in basso a sinistra, con un tono
  di marrone caldo, si contrappone a quello buio e freddo in alto
  a destra, bilanciando tutta la composizione.'),
('Il Giardino Segreto',50,50,'Acrilico su tela', 2020, NULL, 'il_giardino_segreto',
  'La tela, quadrata, presenta un inserto a collage: il frammento 
  dell''immagine molto decorativa di un cancello con lavorazione a 
  ferro battuto su sfondo azzurro. Le pennellate semplici di marrone 
  (verticalmente) poi verde bianco grigio/blu alla base, alludono 
  allo spazio di un giardino con alberi e viali mentre a destra, 
  un''ampia stesura chiara riprende la forma quadrata di base 
  realizzando uno spazio prospettico arioso e luminoso.'),
('Valico', 150, 100, 'Acrilico su tela', 2020, NULL, 'valico',
  'La tela, verticale e di grandi dimensioni, presenta 
  contrasti di colore caldo freddo e contrasti chiaroscurali. 
  Le pennellate sottolineano la verticalità dello spazio. 
  Le masse più scure sul lato destro formano quasi una parete 
  rocciosa che culmina in alto con una serie di linee orizzontali, 
  pennellate e grafismi che collegano le masse da destra a 
  sinistra come un ponte di passaggio.'),
('Juliet', 40,30, 'Acrilico su carta da scena intelaiata', 2000, 'Collezione Privata (Milano)', 'juliet',
  'Questa piccola tela verticale presenta come texture di 
  base la trascrizione di un brano tratto dal testo Romeo 
  e Giulietta di Shakespeare, realizzata appunto come un 
  tessuto chiaroscurale di segni grafici espressivi sul 
  quale il colore si spande liquido e prevalentemente trasparente.
  Sullo sfondo cosparso di mezzi toni sfumati e calligrafia 
  leggera risaltano le tonalità del giallo primario e 
  del rosso vermiglio e un''unica ombra scura sotto 
  quest''ultimo, a dare la necessaria profondità e concretezza.'),
('Sorretto dalle Stelle', 100, 80, 'Acrilico su tela', 2007, NULL, 'sorretto_dalle_stelle',
  'Il dipinto, realizzato quasi totalmente con tonalità fredde 
  nella gamma di blu azzurro e bianco, presenta effetti di 
  contrasto chiaroscurale dato dal ripetuto accostamento di bianco e 
  blu scurissimo. Nella parte centrale il bianco è distribuito in 
  piccole gocce sfumate sul fondo azzurro blu, con un effetto di 
  luminosità diffusa e frammentata. In alto, al centro, si staglia la 
  figura stilizzata di un profilo umano rivolto a sinistra. 
  In basso, una massa rosso vivo dona peso e concretezza 
  all''intera composizione.'),
('Volo d''Uccello', 80, 90, 'Acrilico su tela', 2008, NULL, 'volo_d_uccello',
  'In questa tela, quasi quadrata, la figura stilizzata di 
  un uccello solca tutto lo spazio in diagonale, in picchiata, 
  con la testa in basso a sinistra, la coda in alto a desta e 
  un''ala aperta verso lo spigolo in basso a destra, 
  sottolineando con dinamismo la diagonale opposta. 
  il giallo, colore dominante, contrasta col viola, 
  suo complementare, mentre il verde, neutro, fa da mediatore, 
  e il blu-nero crea ombre profonde che staccano 
  vividamente il soggetto dallo sfondo.'),
('Danae', 60,50,'Acrilico su tela', 2019, NULL, 'danae',
  'Il quadro rappresenta un''omaggio a Klimt e alla sua 
  opera omonima, ma la raffigurazione diventa del tutto
  astratta e simbolica. I colori, e il loro andamento, 
  diventano gli unici referenti: a sinistra il nero 
  (maschile) verticale, con la sua pioggia d''oro 
  (il giallo acceso screziato di marrone), mentre 
  Diana compare nel rosso-arancio ondulato e vibrante 
  dei suoi capelli. il grigio chiaro, neutro in alto a 
  destra, ma compare lievemente anche in entrambi i 
  lati della tela, rappresenta l''incantesimo,
  il sonno, l''incoscienza e la mancanza di volontà.'),
('Eco',50,150,'Acrilico su tela', 2018, 'Collezione privata (Verona)', 'eco',
 'In questa tela, fortemente rettangolare, i colori 
  sono ripartiti in tre fasce orizzontali che ne esaltano
  il formato. Nella parte centrale il turchese scurissimo 
  è diluito fino a diventare trasparente, in una sorta di
  alta marea. Gli altri colori, dai toni molto più caldi e 
  squillanti, si ripetono obliqui, ritmici, tagliando quella 
  superficie come suoni che, rimbalzando, si ripetono cristallini.'),
('Filigrana',60,50,'Acrilico su tela', 2019, NULL, 'filigrana',
  'Il dipinto è quasi perfettamente diviso a metà da una diagonale. 
  La parte in alto a sinistra, dalle tonalità calde,
  sfumate e morbide come un tessuto leggero, contrasta 
  con la parte in basso a destra, grigia, argentea, 
  solcata da filamenti più scuri e texturizzata da 
  piccole gocce allineate di colore non disciolto in 
  quella base fluida, come un metallo raffreddato, 
  lavorato, punzonato o trafilato.'),
('Un Nuovo Inizio',80,60,'Acrilico su tela', 2019, 'Collezione privata (Verona)', 'un_nuovo_inizio',
  'Il dipinto, verticale, di dimensioni medie, 
  con un semplice incrocio prospettico di liee che 
  convergono al centro della composizione allude ad una
  soglia, un passaggio dal buio (il triangolo alla base) 
  alla luce rappresentata nel il bianco a sinistra.
  La forma di destra, dal colore neutro, è la porta 
  che si apre sullo spazio accecante, vibrante di luce, 
  ed è proprio il riverbero a rendere viva e intensa la 
  composizione, altrimenti così statica, semplice e simmetrica.'),
('Coniglio', 80,70,'Acrilico su tela', 1996, NULL, 'coniglio',
  'L''opera racchiude nello sfondo una frase tratta 
  da Alice nel Paese delle Meraviglie. é la 
  frase che che introduce l''arrivo del coniglio bianco, 
  rappresentato al centro della tela con la sola testa, 
  come una maschera, a sottolineare il carattere fiabesco 
  e surreale del testo. Il muso sembra immergersi nel colore 
  stesso dello sfondo, tagliandolo e creando un''ombra densa 
  e scura alle sue spalle. Una pennellata rosso vivo che
  culmina in un colore scurissimo, "cade" invece obliqua, 
  dinamica e vivace, davanti al coniglio bianco, come un 
  suono squillante che ci risveglia dal sonno e dal sogno.'),
('Sottobosco',50, 50, 'Acrilico su tela', 2016, NULL, 'sottobosco',
  'L''opera, quadrata, raffigura un ramo di felce dal colore verde
  giallastro inserito su di un fondo marrone bruciato che sfuma
  obliquo, lungo una diagonale che taglia l''andamento delle foglie,
  via via nel rosso, arancio e giallo, passando dall''ombra del
  sottobosco dove si inserisce la pianta fino ad una luce splendente.
  Tutti i colori sono frammentati, screziati da toni chiari e scuri,
  evocando quel gioco di riflessi che si vede in natura quando
  la luce del sole passa fra i rami degli alberi.'),
('Pesce Rosso',60,60,'Acrilico su tela',1995, NULL, 'pesce_rosso',
  'Il dipinto è realizzato su un ritaglio di tela di juta,
  sfrangiato, quadrato, leggermente più piccolo della tela di 
  supporto sul quale è applicato. Il pesce è rappresentato 
  prevalentemente dal corpo a ogiva, solido ma morbido e 
  sinuoso. Il suo rosso vivo risalta su una fascia d''ombra 
  verticale blu verdastra, e su una forma quadrata blu scuro 
  che fa da sfondo, ma che è quasi completamente 
  coperta dal soggetto. La sua forma attraversa tutta 
  la composizione in diagonale, dove e sembra fluttuare 
  leggera circondata di luce.'),
('Busto',40,30,'Acrilico su tela',1992, 'Collezione privata (Padova)', 'busto',
  'L''opera, in coppia con Robusto, è realizzata su una tela 
  grezza senza imprimitura montata su una tavoletta di legno. 
  Il colore, lavorato per velature, molto liquido, varia in modo
  diffuso fra toni di giallo caldo e blu-verde e fa da sfondo ai 
  disegno di un busto femminile schematizzato con larghi tratti di 
  carboncino. Questa sorta di primitivismo e la tecnica utilizzata 
  trasmettono quasi una sensazione di matericità al dipinto, pur 
  essendo questo in realtà molto liscio.'),
('Robusto',40,30,'Acrilico su tela',1992, 'Collezione privata (Padova)', 'robusto',
  'L''opera, in coppia con Busto, è realizzata su una tela 
  grezza senza imprimitura montata su una tavoletta di legno. 
  Il colore, lavorato per velature, molto liquido, variando in modo 
  diffuso fra toni ambrati, azzurro e blu-verde, fa da sfondo ai 
  disegno di un organo sessuale maschile schematizzato con pochi 
  tratti di carboncino. Questa sorta di primitivismo e la tecnica 
  utilizzata trasmettono quasi una sensazione di matericità al dipinto, 
  pur essendo questo in realtà molto liscio.'),
('Colore', 50, 150, 'Acrilico su tela', 2008, NULL, 'colore',
  'L''opera, su tela dal formato rettangolare molto allungato, 
  orizzontale, presenta sullo sfondo , con stile calligrafico 
  espressivo, la definizione da dizionario della  parola 
  "colore". La scrittura viene letteralmente sommersa da 
  chiazze libere, coprenti e trasparenti: rosso e giallo saturi,
  verde brillante, blu scuro e grigio neutro. 
  I colori, autocelebrativi, seguono una lunga curva 
  orizzontale, distesi in un movimento ampio, vivace e nel 
  contempo armonioso.');

CREATE TABLE utenti (
  user_name VARCHAR(20) NOT NULL,
  password VARCHAR(20) NOT NULL,
  PRIMARY KEY (user_name)
);

INSERT INTO utenti(user_name, password) VALUES
('admin', 'admin'),
('user', 'user');


CREATE TABLE prenotazioni( 
  id BIGINT(20) AUTO_INCREMENT PRIMARY KEY, 
  user_id VARCHAR(20) NOT NULL, 
  opera_id VARCHAR(50) NOT NULL, 
  messaggio VARCHAR(256) NOT NULL, 
  data_inserimento DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES utenti(user_name) ON DELETE CASCADE, 
  FOREIGN KEY (opera_id) REFERENCES quadri(titolo) ON DELETE CASCADE 
);

CREATE TABLE contatti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    cognome VARCHAR(50),
    telefono VARCHAR(15),
    testo_libero VARCHAR(256),
    data_inserimento TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
