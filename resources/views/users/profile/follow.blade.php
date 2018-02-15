<div>
<form action="/following" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="follow_id" value="{{$user->id}}">
    <button class="button is-primary"type="submit">Follow</button>
</form>
</div>