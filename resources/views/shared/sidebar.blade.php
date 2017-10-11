<div class="box is-shadowless">
	<div class="content">
		<h3>Archives</h1>
	    <ol class="list-unstyled">
        @foreach ($archives as $stats)
          <li>
            <a href="{{ route('blog.index') }}?month={{ $stats->month }}&year={{ $stats->year }}">
              {{ $stats->month . ' ' . $stats->year }}
            </a>
          </li>
        @endforeach
      </ol>

	</div>
</div>
