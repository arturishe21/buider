<?php $ancestors = $current->getAncestorsAndSelf(); ?>

@foreach ($ancestors as $ancestor)
    <a href="?node={{ $ancestor->id }}" class="node_link">{{ $ancestor->title}}</a> /
@endforeach
