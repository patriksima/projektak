<tr>
    <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->start->format('j.n.Y') }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->end->format('j.n.Y') }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->worker->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->project->client->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->project->name }}</td>
    <td class="mdl-data-table__cell--non-numeric">{{ $worksheet->task }}</td>
    <td>{{ $worksheet->duration }}</td>
    <td>{{ $worksheet->amount }}</td>
</tr>
