@extends('inizio')

@section('content')
    <div style="height: 32rem;" xmlns:livewire="">
        <livewire:livewire-column-chart
            :column-chart-model="$columnChartModel"
        />
    </div>
@endsection
