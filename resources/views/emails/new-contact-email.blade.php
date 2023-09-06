<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Contatto dal Tuo Sito Web</title>
  </head>
  <body>
    <h1>Ciao,</h1>
    <p>Hai ricevuto un nuovo messaggio dal tuo sito web. Ecco i dettagli:</p>

      <p><strong>Nome:</strong> {{ $contact->name }}</p>
      <p><strong>Email:</strong> {{ $contact->email }}</p>
      <p><strong>Messaggio:</strong> {{ $contact->message }}</p>

    <p>Per favore, rispondi a questo messaggio al più presto.</p>
  </body>
</html>

</html>