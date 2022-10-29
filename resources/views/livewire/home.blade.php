<div class="card-body">

    <div class="row gy-4">
        <x-card :value="$info->cursos" label="Cursos" icon="book"></x-card>

        <x-card :value="$info->docentes" label="Docentes" icon="user-tie"></x-card>

        <x-card :value="$info->alumnos" label="Alumnos" :subtitle="date('Y')" icon="user-graduate"></x-card>

        <x-card :value="$info->grupos" label="Grupos" icon="user-friends"></x-card>
    </div>
</div>
