Symfony2 project.

Zaczynamy!

Aby pobrać wymagana obsługa gita lub wrodzony spryt i chęć do szperania w necie.

W Linuxach z konsoli instalujemy gita i w konsoli dajemy:

    git clone https://github.com/chiave/bluerose <nazwa katalogu>

nazwa katalogu - nazwa katalogu, gdzie ma być wsadzony projekt. Musi być on pusty.

Po sklonowaniu kodu z repo z poziomu katalogu głownego (a więc tego, co wpisaliśmy w <nazwa katalogu>) używamy narzędzia do pilnowania zależności - composera. Użycie:

php composer.phar selfupdate
php composer.phar install



Uwagi:
    projekt uruchamiamy przez:

http://localhost/<ścieżka do katalogu web>/app.php
        lub                                app_dev.php

Symfony2 jest cacheowane dla wersji app.php co oznacza, że nie widać tam wprowadzanych zmian od razu. Aby były one tam widoczne należy wywalić zawartość katalogu app/cache (ręcznie, lub poleceniem z konsoli, bez różnicy). Wersja app_dev.php (deweloperska) jest wolna od tej niedogodności, ale też działa wolniej.

Z poziomu konsoli mamy dostępne całkiem przyjazne narzędzie. Aby wywołać listę komend wpisujemy:

    php app/console

W pliku app/config/parameters.yml trzymane są wszystkie ustawienia, jak dane do serwera mailowego, czy bazy danych. Po utworzeniu sobie lokalnej bazy danych trzeba tam wprowadzić stosowne zmiany. Cały czas dostępny jest tam też plik parameters.yml.dist, który jest przykładem "nieruszanego" pliku.



Parę linków:

Oficjalna dokumentacja:                 http://symfony.com/doc/current/book/index.html
Polska wersja (minimalnie nieaktualna): http://symfony-docs.pl/



Tyle na start - zachęcam do pisania ticketów w zakładce Issues. W razie problemów z Symfony, serwerem, gitem lub czymś związanym z projektem można śmiało zaczepiać tutaj, na IRC-u, gTalku i mailowo.


EDIT:
Utworzyłem trzy pierwsze bundle. Wszystkie siedzą w src/Chiave


CoreBundle:
    Będzie służył do niewielu rzeczy, ale takie jest jego założenie. Obsługa logowania, może szablony niektórych widoków. Na razie nie robi nic.

ErepublikScrobblerBundle:
    Chyba najtrudniejsze co nas czeka. Będzie miał za zadanie skanować co jakiś czas eRepublik, a to co wyszpera będzie zapisywał do bazy danych. Na chwilę obecną przewiduję, że będzie on działał cały czas iterując po id-kach userów, firm, bojówek i czego nam tylko przyjdzie do głowy. Pytanie tylko, czy nas erepublik wtedy nie zablokuje. Jeśli tak, ograniczymy się do listy zarejestrowanych nastronce userów.

StatsBundle:
    Tutaj będą się wykonywały wszelakie automagiczne czynności na zescrobblowanych danych. Przeliczanie, wyliczanie, podliczanie, zliczanie, i wszystko inne. Cel prosty.

StaticBundle:
    W zasadzie gotowy do użytku. Jego zadaniem jest wyświetlanie stron statycznych. Controller jest całkiem prosty - ma za zadanie przekierować wchodzącego na <naszadomena>/xyz usera do widoku xyz.html.twig siedzącego w src/Chiave/StaticBundle/Resources/views/Frontend. Cokolwiek będzie wpisane po slashu - do takiego zasobu nas wyśle. Gdy zasób nie istnieje - zwraca 404. Bundle przyda się dla każdego, kto będzie pracował nad wyglądem stron, bo tutaj może to robić na spokojnie bez obaw, że jakieś dziwne dane wyjściowe będzie dostawał.

MilitaryUnitBundle:
    Bundle z rzeczami specyficznymi dla bojówki. Nie mam pewności co tu wsadzimy jeszcze, ale celuję w takie rzeczy jak wysyłąnie PM-ek, linki do profilów, mapy, dotacje, wewnętrzne informacje, wyliczenia należności i tym podobne. W skrócie - narzędzia ułatwiające pracę bojówce.
