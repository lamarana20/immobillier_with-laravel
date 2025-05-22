<x-mail::message>
# Nouveau message de contact

Une nouvelle demande a été faite pour le bien :

<x-mail::button :url="route('property.show', ['slug' => $property->getSlug(), $property])">
{{ $property->title }}
</x-mail::button>

---

**Prénom :** {{ $data['first-name'] }}  
**Nom :** {{ $data['last-name'] }}  
**Email :** {{ $data['email'] }}  
**Téléphone :** {{ $data['phone'] }}  

**Message :**  
{{ $data['message'] }}

---

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
