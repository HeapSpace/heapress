# Tema

`heapress` tema je predviđena da se koristi na svim HS sajtovima. Karakteristične osobine:

+ Koriste se samo HS boje (dodati nove nije problem).
+ Stranice su podeljene u sekcije, koje koriste nove boje.
+ Glavni meni je uvek okrenut za 90 stepeni i nalazi se levo.
+ Tipografija je suštinski deo dizajna.

Da bi se tema upotrebljavala na drugim sajtovima, a da oni ne budu "slepa kopija" glavnog HS sajta, napravljena je da bude SLOBODNA_: moguće je napraviti dosta izmena, ali to iziskuje izvesno upoznavanje s temom, a smanjuje broj parametara za konfiguraciju. Tako, na primer, tema nema podešavanja za linkove ka socijalnim mrežama, to se piše ručno, jer se ostavlja mogućnost da se to napravi na bilo koji način. Slično, ne definiše se sadržaj footera, već se i on ručno piše.

## Sekcije

Sekcije strane je blok teksta sa određenom bojom pozadine. Definiše se na dugme, čime se ubacuje sledeći kod u editor:

```
[hs-section color="red"]Ovo je moja sekcija[/hs-section]
```

Ovakav blok se boji HS crveno.

### Sekcije na drugim stranama

Postoji opcija da se dovuče sekcija sa neke druge strane. Za to služi atribut `page`:

```
[hs-section color="red" page="_neki_slug"][/hs-section]
```

Sadržaj je sada definisan na drugoj strani, čiji je slug: `_neki_slug`. Preporuka je da ta strana bude privatna.

## Vrste šablona za stranice

+ `Default` template podrazumeva da se koriste sekcije.
+ `Single Section` template podrazumeva da se koristi jedna sekcija i ne treba ih definisati u editoru. Ima sledeći page atribute:
++ `page_color` - boja stranice, inače definisana u podešavanjima teme.

## Partials

Sadržaj se može ubacivati i kao partials, pa se preporučuje da se oni imenuju sa `_` prefiksom i da budu privatne strane.

## Podešavanja teme

+ `Content > primary color` je primarna boja strane i pozadine.
+ `Content > footer slug` je ime footer strane
+ `Content > footer color` je boja footera
+ `Content > header color` je boja headera
+ `Text > footer` je sadržaj koji se ispisuje na kraju footer, obično copyright.

## Stilovi

Postoje posebni stilovi za različite elementa:

+ `Big Link` - stil koji se dodaje obično na linkove, da bi bio veći (kao neki call-to-action).
+ `Big H2` - stil primenjen na brojke
+ `SuperBig H2` - stil za baš velike brojeve.

Svi HS stilovi u editoru imaju žutu pozadinu, da bi bilo jasnije da su izmenjeni.

## Šta se može dodati?

Ukoliko treba, tema se može relativno lako dopuniti. Sledi spisak elemenata teme koji se mogu dopuniti, sa relativnom težinom izvedbe (`1` - lako, `3` - treba više vremena).

+ novi stil u editoru (`1`)
+ nova HS boja (tj. kombinacija) (`1`)
+ novi meni (`2`)
