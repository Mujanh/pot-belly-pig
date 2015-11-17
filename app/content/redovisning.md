Redovisning
====================================

Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------

####Vilken utvecklingsmiljö använder du?
Jag använder mig av en dator med operativsystemet Windows 10. Som texteditor har
jag valt att fortsätta använda jEdit, som jag använde i de tidigare kurserna på BTH, men jag har även börjat testa på Atom.
Jag arbetar för det mesta i Mozilla Firefox när jag gör uppgifterna, men använder mig även
av Chrome som en ytterligare webbläsare. För att klona Anax-MVC från github använde jag mig
av Cygwin, som vi också det använt tidigare. Förutom dessa program använder jag även
FileZilla och Xampp för att kunna lägga över material på studentservern resp. att
arbeta lokalt.

####Är du bekant med ramverk sedan tidigare?
Inte jättebekant, kan jag inte säga. Den erfarenhet jag har kommer framförallt ifrån vårt
Anax-base i oophp (som ju såg lite annorlunda ut från det vi håller på med nu). Jag testade även på
AngularJS-kursen på Codecademy under sommaren och där använde man sig av controller, view och model, så
som vi gör nu i php-mvc, så det blev en liten aha-upplevelse när jag började denna kurs eftersom jag
då inte visste vad just mvc-ramverk var för något innan. Så man kan säga att jag har koll på vad
ramverk är för något sedan tidigare, men inte stor efarenhet av specifika ramverk eller hur man använder dem.

####Är du sedan tidigare bekant med de lite mer avancerade begrepp som introduceras?
Jag väljer att tolka "lite mer avancerade begrepp" som t.ex. traits, dependency injections och liknande som vi fick läsa om i kursmomentet.
Det mesta var nytt för mig, förutom inheritance som jag passade på att läsa om igen för att
repetera det vi lärt oss tidigare under våren. Men det var intressant att lära sig om olika sätt
att ge objekt/klasser olika egenskaper och knyta ihop dem genom olika typer. Jag kan absolut se
att det kan vara väldigt användbart att använda sig av de olika begreppen, eller "metoderna". Det
jag hade svårast att få grepp om var nog Dependency Injections, framförallt för jag hade svårt att
hitta något som beskrev exakt vad det är för något. Det fanns en hel del information om hur
man använder det, men jag tycker det var lite knepigt att få en klar bild av vad exakt som var
just dependency injections och vad som var något annat.

####Din uppfattning om Anax, och speciellt Anax-MVC?
Jag gillar ordning och reda så för mig känns det toppen med ett ramverk, så som Anax-MVC. Det
är klart att det inte är helt lätt att ta till sig allt på en gång, så det kommer nog ta
ett tag innan det känns helt solklart vart allt placeras och när/hur man ska dela upp kod
i separata filker och så vidare. Det är ju även mycket kod som redan är skriven i vårt
Anax-MVC, och även det tar tid att sätta sig in i. Men samtidigt ser jag det som en bra
övning eftersom man troligtvis kommer behöva sätta sig in i andras kod i framtiden med,
det får ta sin tid helt enkelt. Men överlag gillar jag strukturen och när jag väl
kommit in i det lite mer är jag säker på att det kommer kännas bra att ha koden
uppdelad och lätt kunna återanvända de bitar som behövs.

####Allmänt om kursmomentet
Det var mycket att ta till sig och mycket att läsa, men det var ett intressant kursmoment
och överlag gick det hela bra. Efter att ha gjort övningen så var det mesta till uppgiften redan klart,
så då var det mest att ge en liten egen touch på me-sidan med hjälp av css. För att lägga till en bild
på mig med figure-tags använde jag mig av shortcode i min markdown-fil (enbart för just figure, allt annat
är i markdown) eftersom jag inte hittade något sätt att skapa figures i markdown. Hittade hur mos
tipsade om hur man kunde skriva i forumet, så jag valde att använda det med. Hade kunnat använda bara en
image-tag och enbart markdown, men ville gärna ha figure (dels för figcaption, men också för att
jag då kunde använda mig av de klasser som redan fanns i figure.css). Jag valde att göra extrauppgiften med
att kasta tärning, det mesta av koden fanns redan från artikeln om MVC samt i själva ramverket så det jag
gjorde var att lägga in template för dice i min app/view/me-mapp (där mina andra templates för me-sidan ligger) och
ändra lite i texten så den blev på svenska. Sen lade jag till routes för att kasta tärningen i min frontkontroller
index.php. Även fast jag gjorde både tärningsspelet och kalender i förra kursen valde jag
att inte lägga till det då jag i sådant fall skulle vilja förbättra koden i dem och anpassa dem
till Anax-MVC-strukturen först, vilket jag dessvärre kände skulle ta för lång tid just nu.

Däremot laddade jag upp mitt Anax-MVC till GitHub, genom att forka mos Anax-MVC, klona
mitt projekt på GitHub, skapa en remote upstream till mos och sen pusha mina uppdaterade filer till GitHub.
Det var inte helt enkelt eftersom jag aldrig använd GitHub tidigare, men jag lyckades till slut genom att
följa [den här guiden på forumet](http://dbwebb.se/forum/viewtopic.php?t=2320). Det blev kanske inte helt
optimalt med meddelandet när jag commitade eftersom det blev på svenska och jag commitade hela Anax-katalogen på en gång,
men det är något jag ska tänka på till nästa gång.

[Länk till min GitHub](https://github.com/Mujanh/Anax-MVC)

Kmom02: Kontroller och Modeller
------------------------------------

####Hur känns det att jobba med Composer?
Jag tycker att Composer verkar som ett smidigt verktyg att använda sig av när man arbetar med projekt.
Det var inte superenkelt att få grepp om vad Composer faktiskt gör för något och vi använde
det ju inte till så mycket, så det känns dock fortfarande som det är rätt ny mark för mig.
Men det var ju väldigt smidigt att man kunde ange vilka paket man ville att ens projekt skulle
vara beroende av i composer.js och sen installera med composer. Kan tänka mig att det kan vara
användbart framöver, speciellt för projekt som är beroende av flera libraries/paket.
Däremot så blev jag rätt frustrerad när jag skulle installera Composer för det ville inte helt fungera
med Windows förrän jag installerade ner exe-filen (vilket jag inte visste behövdes först). Först installerade jag
det även på studentservern för det lät i guiden först som man skulle göra det, men sedan stod det att det redan
skulle finnas installerat så förhoppningsvis blev inget fel på grund av det.


####Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?
Jag har inte tittat runt så mycket i Packagist förutom att installera det som behövdes för själva kursmomentet. Men
det verkar finnas ganska mycket att välja på där så det finns säkert fler paket som kan vara användbara, men
jag har som sagt inte inkluderat något mer än phpmvc/comment. När jag tittade runt litegrann så upplevde jag dock att
det är det nog är lättare om man innan vet ungefär vad man är ute efter när man börjar browsa, det finns ju
en hel del där som sagt.

####Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?
Det var rätt svårt att komma in i och det tog ganska lång tid bara för att försöka förstå hur allt hängde ihop.
I slutändan känner jag att jag fick någorlunda koll på hur det fungerade tillsammans, men det finns fortfarande
en del att lära. Det är så många olika nya begrepp så det är lite svårt att hålla reda på exakt vad som är vad, t.ex.
vad exakt räknas som en tjänst och vad är egentligen en dispatch. Men som sagt fick jag lite mer kläm på det allteftersom
jag löste bit för bit av uppgiften. Jag var även lite förvirrad först över varför det var uppdelat i CommentController och CommentsInSession,
varför det inte låg i samma, men om jag förstått det hela rätt så är det för kontrollern (CommentController) har som uppgift
att vara mellanhanden mellan själva outputen av sidan (d.v.s vyerna) och anropen till session (som i ett mer komplicerat system säkert
hade varit databasen).


####Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?
Det finns alltid något att förbättra, en sak som jag tänkte på under uppgiftens gång var
att det troligtvis borde finnas mer validering av den input som kommer in från formuläret när
en kommentar skapas. Jag hade tyvärr inte tid att förbättra det allt för mycket men jag lade till
email och url som type till formuläret där inputen för mail-adress och hemsida anges. På så sätt
går det åtminstone att checka så att det är rätt input i de fälten. För att undvika att de fälten behöver
vara ifyllda om man vill ta bort alla kommentarer så använde jag formnovalidate på remove-knappen. Sen
såg jag även till att lägga till textfilter för nl2br i kommentarsfältet. När man visar kommentaren som
vill editeras använde jag även strip_tags för att ta bort de tags som skapades när man använde sig av det texxtfiltret så
att användaren inte skulle behöva se det. Förutom det med valideringar så vore det ju även smidigare att jobba mot
en databas, om man vill kunna göra ett mer riktigt kommentarssystem (för annars sparas det ju bara i session), men
det var inget jag gav mig på nu. Något jag önskade fanns, men som inte hade så mycket med just phpmvc/comment att göra,
var en funktion för att ta bort en nyckel från session, på samma sätt som vi använder set och get med session. Nu löste jag
det med unset-funktionen som finns i php, men det var något jag tänkte på.

####Allmänt om kursmomentet
Det här var ett rätt svårt kursmoment och framförallt tog det väldigt lång tid. Tror jag spenderade
ungefär en full skolvecka på kursmomentet, fastän det bara ska bli 20 timmar eftersom det är halvfart. Det var
svårt att komma igång eftersom man behövde förstå hur allt hängde ihop först och det var inte helt enkelt. Hade
önskat att det var lite mer guidning i hur Anax-MVC fungerade först så man fick lite mer kläm på det innan man
sätter tänderna i en uppgift som det här. När allt väl började falla på plats gick det dock enklare och det var lättare
att komma in i tänket för hur man skulle bygga ihop allt. Jag valde att göra en av extrauppgifterna den här veckan och det var att lägga till gravatar. Jag valde att göra det genom
att skicka med en parameter (med den länk/kod som fanns för gravatar tillsammans med användarens email) till vyn där kommentarerna visas.

Något som jag inte är hundra procent nöjd med men som jag inte visste hur jag skulle lösa annars var att jag i min form.tpl.php
och edit.tpl.php använder en if-sats för att checka om pagekey (dvs vilken sida man är på, kommentar-sidan eller me-sidan som är de två
ställen där jag valde att lägga in kommentarerna på) är comment-page eller me-page för att avgöra vilket värde redirect ska ha. Skulle vilja lösa det
utan att behöva jämföra de två specifika värden jag använder mig av för att sätta pagekey, men jag vet inte om det går och
hur man isådant fall kan lösa det. Hade kanske även kunnat slå ihop visa metoder såsom t.ex. findOne och findAll, men samtidigt kändes
det tydligt att ha det i separata.


Kmom03: Bygg ett eget tema
------------------------------------

####Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?
CSS-ramverk är helt nytt för mig, det är inget som jag har erfarenhet av tidigare. Jag tycker dock
att det verkar riktigt smidigt. Allt sitter väl inte fortfarande till 100% men det kommer nog falla på plats
mer och mer. Det jag framförallt gillar med CSS-ramverk är att det är bra att kunna ha en grund att utgå från,
så kan man relativt enkelt bygga ut och göra om för att skapa den layout/struktur som man vill ha.

####Vad tycker du om LESS, lessphp och Semantic.gs?
LESS och lessphp tycker jag är toppen. Att kunna anpassa css-koden mer genom att använda t.ex.
variabler, funktioner och mixins är jättebra, det gör det hela mer flexibelt. Det är dock en
del nytt att ta in så det tar tid innan det sitter, men jag gillar verkligen konceptet. Semantic.gs
känns också som en bra tillgång att ha, smidigt att kunna styra över utseendet på de olika regioner man skapar
utan att behöva tänka på att sätta klasser på allt. Framförallt när vi satte bredden på regionerna med hjälp av
.columns(), såväl i structure.less som i responsive.less, så märkte man att det var rätt användbart.

####Vad tycker du om gridbaserad layout, vertikalt och horisontellt?
Det vertikala rutnätet (eller vertikala layouten) tyckte jag gjorde stor skillnad när man
stylade sidan. Det ser mycket bättre ut när allt ligger på rätt position och det var lätt att
se och fixa om något hamnade fel. Det horisontella tycker jag var mycket krångligare, även om
det ju onekligen ser bättre ut när element (speciellt t.ex. sidebaren och main-regionens text) ligger på
rätt rad förhållande till varandra. Men jag upplevde det inte alls som speciellt lätt att få allt att
ligga rätt på det horisontella rutnätet, det blir mycket pillande. I slutändan nöjde jag mig med att texten i
mitt tema (förstasidan på frontkontrollern, theme.php) såg ut att ligga i fas med linjerna. Jag flyttade
bakgrundsbilden lite för att det skulle passa. Det resulterade dock i att den inte längre passar på min typsnitt-sida,
men det är för att bakgrundsbilden behöver flyttas något, raderna ska annars ligga i linje i samma grad som exemplet i övningen gjorde
(d.v.s. det börjar bli osynkat vid h3-headern).

####Har du några kommentarer om Font Awesome, Bootstrap, Normalize?
Font Awesome kändes kul att använda, det var enkelt att komma igång och enkelt att integrera de olika ikonerna
på sidan. Tycker även att det bidrar till att ge ett mer professionellt intryck om man lyckas använda det rätt och inte
överanvänder symbolerna. Jag kikade lite på Bootstrap och det finns säkert en hel del bra att låna eller inspireras ifrån där,
men ingenting som jag lånade just nu. Det enda var att vi i övningen gjorde sidan responsiv som baserades på att Bootstrap är
designat enligt Mobile-first. Normalize fördjupade jag mig inte så mycket i hur det fungerade, men det är ju smidigt att
ha en less-fil som hjälper till att göra en konsekvent grundstil för de olika webbläsarna.

####Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?
Jag utgick från det tema som vi skapade under övningarna och valde sedan att styla till det
så det blev en lite mer personlig touch på det. Jag gillade de olika regionerna vi redan hade skapat
så jag såg ingen anledning till att ändra det, men för min exempel-sida som visar det stylade temat
har jag inte fyllt i alla regioner, så det är inte alla som visas samtidigt. Jag gjorde inga
större utsvävningar då det tyvärr skulle ta för lång tid och jag redan spenderat mer än jag
borde på det här kursmomentet. Jag var lite osäker på om man skulle visa rutnätet eller inte i resultatet,
men jag valde att sätta en :hover på min wrapper som visar rutnätet om man hovrar över den.

För den responsiva delen så valde jag att visa footer-cols på en rad för stora skärmar, två rader på
mellanstor och fyra rader på liten skärm. Jag valde även att lägga mina triptych och featured på separata
rader när skärmstorleken blev liten. Sidebaren och main lägger sig också på varsin från mellanstorlek och nedåt,
tyckte sidebaren blev för liten annars. Med min navbar valde jag att göra det enkelt för mig med en dropdown-meny
och bara två huvudalternativ, på så sätt såg navbaren bra ut även för små skärmstorlekar. Om det är något jag kanske
skulle lägga till vore det nog att anpassa font-storlekarna så det blir mer lättläst för små skärmar, men det kändes som
lite överkurs just i det här momentet, men såklart något som är viktigt att tänka på för sidor som ska användas på t.ex. mobiler.

####Antog du utmaningen som extra uppgift?
Dessvärre antog jag inte utmaningen, det skulle krävas mer tid än vad jag har just nu. Däremot
lade jag till extrauppgiften med att kunna styla om sidan lättare. Jag lade till så man kunde
ange klass för såväl body som html genom config-filen. I nuläget finns det två stycken färgteman
att välja mellan för html-klassen 'neutral' (som är den som är vald nu) och 'happy'.

####Allmänt
Kursmomentet tycker jag har gått rätt bra, men det har tagit tid att sätta sig in i allt.
Det är fortfarande inte helt självklart för mig vad jag ska lägga vart när det kommer till
de olika less-filerna som vi har. Speciellt när det kom till att t.ex. sätta färger. Det som
var specifikt för mina två färgteman valde jag att lägga i en ny less-fil som jag kallade för
colorscheme.less, kanske hade jag även kunnat flytta in lite från structure.less där med, men
samtidigt ville jag att min colorscheme skulle vara dedikerad just till de olika färgteman som fanns.

Det blev en del valideringsfel när jag validerade sidan i Unicorn, men vad jag kunde se
berodde det på font-awesome och \*zoom:1 från den kod vi skulle lägga in, så jag hoppas att
det ska vara okej ändå.

Kmom04: Databaser, ORM och scaffolding
------------------------------------

####Vad tycker du om formulärhantering som visas i kursmomentet?
Jag är lite kluven i min åsikt om formulärhanteringen vi hade. Å ena sidan tycker jag
att det var relativt smidigt och man slapp skriva formulären för hand i t.ex. en ny vy, jag kunde
istället återanvända samma vy till att skapa olika formulär. Så det var ju rätt smidigt. Men å andra
sidan så tyckte jag att man blev lite mer begränsad, t.ex. så hade jag tidigare använt mig av
'formnovalidate' på min knapp för att radera alla kommentarer så att jag kunde använda den knappen
även fast det fanns tomma obligatoriska fält i formuläret, men nu verkade inte CForm ha stöd för
det vad jag kunde se. Såklart är det ju säkert sådant som går att utveckla i CForm, även om det inte
var något jag gav mig in på. Sen så känner jag lite att även om det är smidigt att slippa skapa
nya vyer för nya formulär, så måste jag ju ändå skapa förutsättningarna för formuläret i en
action eller klass, så jag är ännu inte helt övertygad om att det egentligen är så mycket smidigare
än att skapa formuläret manuellt. Men det är möjligt att jag känner av nyttan mer när jag är mer
insatt i CForm.

####Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL?
Databashanteringen tyckte jag var jättebra för det mesta. Det kändes lite ovant men bara man
satte sig in i vilka metoder som fanns och vad de gjorde så kändes det överlag bra och lätt
att använda. För de uppgifter vi hade så fanns det relevanta metoder att använda sig av och det
var rätt skönt att slippa skriva all SQL själv och låta metoderna sköta det. Sen som med så många
andra saker så kan man säkert bygga vidare på databashanteringen så att det finns ett större utbud av
metoder, men för vårt syfte så kändes det absolut tillräckligt med det vi hade. Så det får tummen upp av mig.

####Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller?
Nej, jag kan inte påstå att jag gjorde något extra direkt. Det enda
som jag egentligen "lade till" var att byta datumstämpel så det blev rätt tidszon, det gjorde jag genom att sätta en
default timezone och sedan använda date istället för gmdate.
Redan i övningen innan uppgiften valde jag att lägga alla metoder i basklassen och låta User vara tom,
det kändes smidigast så eftersom jag då kan återanvända basklassen
och alla dess metoder för andra syften, så som t.ex. att skapa en modell för kommentarssystemet.

I uppgiften kämpade jag en del för att få allt att hänga ihop på ett bra sätt. Min första tanke
var att ha formulären i separata klasser och hämta dem via formSmallController, och sen att
skickas vidare till UsersController som skulle sköta kontakten med User (så det skulle
bli ungefär: View -> UsersController -> FormSmallController -> CFormSignup -> UserController -> User).
Men jag fick aldrig ihop det på ett bra sätt, blev för många steg och för mycket parametrar som skulle skickas hit och dit, så
jag ändrade taktik efter ett tag. Det jag landade på i slutändan var att skrota formSmallController och
istället nå formuläret med klassen direkt från UsersController. Så t.ex. om man vill lägga till en användare så
blir flödet till User mer: View -> UsersController -> CFormSignup -> User. Man kan säga att jag flyttade in
det som FormSmallController gjorde direkt in i metoden i UsersController. Det känns kanske inte 100 % optimalt
men det var det bästa sättet jag kunde lösa det på i nuläget.
För de funktioner som inte behövde formulär,t.ex. som att radera eller markera som inaktiv så blev flödet istället  View -> UsersController -> User.

Det mesta går att testa direkt på förstasidan för användarna, men om man vill ta bort en användare
permanent så behöver man göra det från papperskorgen. Man kan sortera på de olika vyerna under tabellen
med användarna.

####Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen.
Jag valde att implementera kommentarena i databasen på nästan exakt samma sätt som med
användarna. Jag skapade nya formulärklasser för att lägga till och ändra kommentarer och
jag skapade även en tom modell Comment som använder sig av metoderna i CDatabaseModel.
Flödet blir därför som med användarna: View -> CommentController -> CFormAddComment -> Comment (för de
funktioner som behöver formulär) eller View -> CommentController -> Comment (för de som inte behöver formulär). För
att slippa behöva fylla i fält, som var märkta som required, för att kunna radera alla kommentarer så valde jag att flytta
ut knappen för "radera alla kommentarer" från formuläret där man lägger till en ny kommentar. Istället
finns det två länkar längst ner under formuläret, en för att radera alla kommentarer och en för att
återställa databasen (raderar på både kommentarsidan och förstasidan och skapar default-kommentarer,
var smidigt framförallt när jag testade allting).

####Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.
Nej, tyvärr fanns det inte tid till att göra extrauppgiften denna vecka.

####Allmänt om kursmomentet
Det här var ett enormt tidskrävande kursmoment, ärligt talat så tycker jag det var
lite väl mycket för att hinna med allt på den tid man har. För mig tog det minst det dubbla
av vad det borde tagit och då lade jag knappt någon tid alls på styling, så det var inte
ens där som det drog iväg. Det var mycket att läsa, många övningar och det tog tid att göra och
lära sig uppgifterna. Visst var det lärorikt och man lärde sig en del i slutändan, men personligen
hade jag nog haft lättare att ta till mig mer kunskap om det inte var så mycket på en gång.

Jag är medveten om att det är en del valideringsfel, men detta beror enbart på att jag använde mig
av fontawesome för att snygga till sidan för användarna, så jag hoppas att det inte gör något.



Kmom05: Bygg ut ramverket
------------------------------------

####Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?
Jag hämtade framförallt inspiration från övningen, eller artikeln snarare, som fanns i kursmomentet
och gav exempel på olika moduler som man kunde använda sig av. Det var inte helt lätt att välja först,
kändes som att det var väldigt olika svårighetsgrader på de olika tipsen som fanns där. Mitt första val
var att göra en Escaper-klass, men efter att ha spenderat i stort sett en heldag på det var jag tvungen att byta
till något annat då jag inte hade den blekaste om hur man ska escapa javascript och css t.ex. Det var
svårt att hitta bra information på nätet med (i artikeln det länkades till stod det bara väldigt översiktligt)
och det var ju inget som vi gått igenom tidigare vad jag vet. Så mitt val föll till slut på att skapa en HTML Helper
som skapar HTML-tabeller från arrays. Jag utgick från det som jag skapade tidigare i oophp-kursen men gjorde
om det mesta så att det passade mitt behov nu lite bättre. Jag lade även till så att man kunde välja mellan
lite olika design på tabellerna genom en tredje parameter (som blir namnet på css-klass) som skickas till modulens klass, det finns fyra förbestämda
stilar och användaren kan även välja att skippa stil eller göra egen styling genom att skicka med ett eget css-klassnamn.

####Hur gick det att utveckla modulen och integrera i ditt ramverk?
Det gick bra att utveckla modulen så snart jag hade bytt till HMTL Helper istället för CEscaper. Det
blev en ganska simpel klass och jag valde att inte bygga in eller koppla databashantering till den, utan
modulen tar helt enkelt två arrays för att skapa en HTML-tabell (och en string för att sätta klass på tabellen). Jag kände att det blir lite mer flexibelt
på så sätt eftersom man då även kan använda modulen utan att hämta rader från just en databas. Det innebär också
att man egentligen kan använda modulens klass utanför Anax-MVC också eftersom den inte är beroende av något som specifikt finns
i ramverket, exempelfilen behöver dock Anax-MVC för att fungera.

Det gick även bra att integrera modulen i ramverket, både i den variant jag kör på nu och i en ren installation av Anax-MVC. Det enda
man behöver göra är att flytta ```TableExample.php``` till Anax-MVC/webroot (om man vill kunna se exempelfilen) och ```ctablehelper.css```
till Anax-MVC/webroot/css (om man vill använda förbestämd styling). Man kan även använda enbart klassen om man vill det.

####Hur gick det att publicera paketet på Packagist?
Förvånansvärt bra, faktiskt. Det gällde bara att sätta sig in lite i hur allt fungerade men det var väldigt
straight forward när man väl hade lagt upp kursrepot på Github och kopplat ihop sin Packagist med Github-kontot.
Jag var mer osäker när jag skapade kursrepot på Github eftersom jag inte var helt hundra
på vilka filer vi behövde ha med där, i vissa av mos exempel-repon finns t.ex. scrutinizer, vilket jag inte vet hur det fungerar eller om
det ska vara med (och i sådant fall hur man använder det).

####Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?
Skriva gick rätt bra, skulle jag säga, men det är svårt att veta exakt vad som behöver vara med där.
Men jag tror att jag fick med det mesta ändå. Att testa modulen med Anax-MVC gick jättebra, till min förvåning stötte jag inte på några
problem när jag testade den med det nuvarande kursmomentet såväl som i en ren installation av Anax-MVC. Men jag testade ju modulen
lite eftersom jag lade in kod i den så jag hade nog fångat upp det mesta innan.

####Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.
Nej tyvärr fanns inte tid till detta.

####Allmänt
Det här var ett tidskrävande kursmoment (vilket ofta är fallet i den här kursen har jag märkt), framförallt
tog det tid eftersom jag kände att det saknades relevanta övningar och relevant kurslitteratur inför det vi skulle göra.
Boken tog ju t.ex. inte upp Packagist, utan handlare om PEAR. Det fanns inte heller någon övning eller artikel som förberedde
en inför flera av de moduler som tipsades om att man kunde införa, t.ex. som Escaper-modulen. Mycket tid gick till att leta runt på internet
och försöka förstå hur man kan bygga liknande moduler, men det är inte alltid så lätt för koden kan vara väldigt lång och komplicerad (och man
vill ju inte heller rakt av kopiera något som redan finns) eller svår att hitta. Jag tyckte även att det saknades information om vilka
filer som bör vara i kursrepot, det enda som står i "övningen" är "Titta i mina repon och använd de filerna som grund när du skapar ditt eget repo."
Resultatet är inte särskilt självklart när de exempel-repon som listas innehåller olika filer, t.ex. så innehåller CForm och CDatabase många
fler filer än phpmvc-comment, några exempel är ```.scrutinizer.yml```, ```phpdoc.xml```, ```.travis.yml```, ```autoloader.php``` och
en test-mapp. I slutändan valde jag att gå på det som fanns i phpmvc-comment, mest för att jag inte hade någon aning om ifall de andra
filerna skulle vara med och hur man i sådantfall skulle skriva dem för att passa min modul.

Även denna vecka var det lite valideringsfel, men detta är samma som tidigare och beror på font-awesome.

Kmom06: Verktyg och Continuous integration
------------------------------------

####Var du bekant med några av dessa tekniker innan du började med kursmomentet?
Nej, det var inget som jag kände till sedan tidigare så det var helt nytt. Minns att jag påpekade förra
momentet att filer såsom travis låg i mos kursrepo men att jag inte visste om det var något vi skulle
använda eller vad det var, men nu vet jag mer om det hela så det är bra.

####Hur gick det att göra testfall med PHPUnit?
Det gick bra faktiskt. Var lite osäker till en början vad som skulle testas men jag utgick från exemplen
som fanns och testade det jag kunde komma på som var möjligt att testa i min modul. Det är ju egentligen bara en metod i klassen
som är publik så jag såg till att testa den på flera olika sätt för att säkerställa att allt fungerar som det ska. T.ex. så testade jag
att bygga html-tabeller som jag visste borde generera ett felmeddelande (eftersom någon av variablerna blev fel) och kollade så att
felet fångades upp som det skulle (jämförde felmeddelande med hjälp av assertequals).
Jag hade nog mer problem med att installera PHPUnit på datorn än att skriva själva testerna, det krävdes en hel del testande för att få det att fungera med Cygwin, men
löste det hela till slut med att använda ett alias för phpunit. Jag behövde även lägga till whitespace i phpunit.xml-filen för att få det att fungera med xdebug annars fick jag
bara felmeddelande om att whitespace saknades.

####Hur gick det att integrera med Travis?
Det gick bra, var inga större konstigheter alls utan det hela skötte nästan sig självt. Dock så var Travis lite segt i början
men sen gick det bättre när den väl hade byggt första gången. Fick bygga ganska många gånger eftersom jag försökte förbättra
koden efter vad scrutinizer gav för meddelande.

####Hur gick det att integrera med Scrutinizer?
Även det gick bra, det var inga problem. Det var bara att följa stegen som fanns i artikeln/guiden så gick det smidigt.
Sen tyckte jag det var toppen att kunna förbättra koden lite utifrån den rapport som man fick ifrån Scrutinizer.

####Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?
Det var faktiskt inte lika krångligt som jag trodde att det skulle vara. Det är klart att det kändes lite ovant och det
tar ju lite tid innan allt sitter men jag tycker ändå att det känns rätt så smidigt. Det känns motiverande att kunna förbättra koden
och hela tiden kunna se framstegen, den biten är toppen. Sen gillar jag även testerna, för även om det tog lite tid att skapa dem och
att se till att allt testas ordentligt så underlättar det faktiskt mycket sen när man ändrar om i koden och vill kunna testa om
det fungerar som det ska. Jag gjorde t.ex om en del i min modul (delade upp i fler metoder) efter vad som stod i scrutinizer och
då kunde jag testa sen om mina tester visade att modulen fortfarande fungerade efter alla ändringar (och visst hade ett slarvfel
letat sig in så då kunde jag enkelt upptäcka det och fixa det). Så absolut, jag kan tänka mig att fortsätta använda dem.

####Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.
Nej, jag valde att inte göra extrauppgiften den här veckan tyvärr.

####Allmänt
Det här momentet är nog det som tagit minst tid av kursmomentet hittills i den här kursen, men med det sagt så
tycker jag att momentet kändes helt lagom. Jag har ofta upplevt att det varit lite mycket i veckorna men den här veckan
var bra. Instruktionerna tyckte jag på det stora hela hjälpte en hel del och det var inte allt för omständigt att göra
uppgiften. Men då är min modul inte heller beroende av något i Anax-MVC så det gjorde det säkert lite enklare.

Kmom07/10: Projekt/Examination
------------------------------------

Kommer senare...
