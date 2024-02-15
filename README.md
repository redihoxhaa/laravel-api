# ESERCIZIO

#### CONSEGNA DELL'ESERCIZIO 

```
Ciao ragazzi,
continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo.

L’esercizio di oggi è suddiviso in milestone ed è importante che ne seguiate l’ordine.

Milestone 1
nome repo 1: laravel-api
Aggiungiamo al nostro progetto Laravel una nuovo Api/ProjectController. Questo controller risponderà a delle richieste via API e si occuperà di restituire la lista dei progetti presenti nel database in formato json.

Milestone 2
Testiamo la chiamata API tramite Postman e assicuriamoci di ricevere i dati correttamente.

Milestone 3
nome repo 2: vite-boolfolio
Iniziamo ad occuparci della parte front-office della nostra applicazione: creiamo un nuovo progetto Vue 3 con Vite e installiamo axios.
Colleghiamo questo progetto ad una repo separata.

Milestone 4
Nel componente principale della nostra Vue App facciamo una chiamata API all’endpoint costruito nel progetto Laravel (milestone 1) e recuperiamo tutti i progetti dal nostro back-end.
Stampiamo in console i risultati e verifichiamo di ricevere i dati correttamente.

Milestone 5
Creiamo un nuovo componente ProjectCard, che corrisponde ad una card per visualizzare un progetto. Utilizziamo questo componente per visualizzare tutti i progetti ricevuti tramite API.

Bonus
Gestire la paginazione dei risultati
```

#### SVOLGIMENTO

Cominciamo con il creare il nostro controller per le API dei progetti tramite il comando `php artisan make:controller Api/ProjectController`, per posizionarlo dentro
una cartella chiamata Api all'interno dei controller. Successivamente nel file api.php andiamo a dettare una rotta, in questo caso /projects, che rimanderà al metodo
index del controller appena creato e importato. Questo metodo index, una volta effettuata una query tramite il nostro modello ci restituirà una stringa in formato json,
dei nostri progetti.

Proviamo ad effettuare una chiamata con Postman per verificare che sia tutto funzionante.

Per sicurezza nel file .env definiamo un'istruzione che contiene l'URL dal quale andremo a fare la chiamata nel front-end, e la passiamo, assieme a un URL di default,
nel file cors.php -> `'allowed_origins' => [env('APP_FRONTEND_URL', 'http://sonoautorizzato.it')]`.

Nel nostro progetto di front-end quindi, installiamo axios, e nell'App.vue definiamo un metodo che fa una chiamata axios in get all'indirizzo che abbiamo definito per l'API.
Una volta ricevuti i dati correttamente possiamo passarli tramite le props ai nostri componenti, per ciclarli, leggerli e visualizzarli nel nostro front-end, attraverso
un elenco di cards.

Possiamo gestire anche la paginazione dei nostri risultati. Per fare questo dovremo cambiare il metodo utilizzato nel modello, che non sara più all(), ma paginate(n).
Dovremo andare a cambiare il breadcrumb sulla response per reperire i dati corretti. Laravel tramite il metodo di paginazione ci offre una varietà di link e dati utili
direttamente all'interno dell'API per consultare le pagine. Potremo usare dei link dinamici che vengono rimappati ogni volta che si fa una chiamata, oppure potremmo
optare per riesplorare un po i concetti di emit, per andare a gestire a mano lo scorrimento delle pagine, implementando dei metodi e delle condizioni che rispettino lo
scorrimento alla pagina precedente fino alla 1 e successiva fino al numero di pagine totali che ci ricaviamo dalla chiamata.

