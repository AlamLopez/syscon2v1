@extends('principal')

@section('contenido')

    <template v-if="menu==0">
        <example-component></example-component>
    </template>

    <template v-if="menu==1">
        <h1>Contenido del menu 1</h1>
    </template>

    <template v-if="menu==2">
        <h1>Contenido del menu 2</h1>
    </template>

    <template v-if="menu==3">
        <empleados></empleados>
    </template>

    <template v-if="menu==4">
        <tipoactividades></tipoactividades>
    </template>

    <template v-if="menu==5">
        <subactividades></subactividades>
    </template>

    <template v-if="menu==6">
        <h1>Contenido del menu 6</h1>
    </template>

    <template v-if="menu==7">
        <h1>Contenido del menu 7</h1>
    </template>

    <template v-if="menu==8">
        <usuario></usuario>
    </template>

    <template v-if="menu==9">
        <rol></rol>
    </template>

    <template v-if="menu==10">
        <h1>Contenido del menu 10</h1>
    </template>

   <template v-if="menu==12">
        <generalidades></generalidades>
    </template>

    <template v-if="menu==11">
        <actividades></actividades>
    
    </template>
      
      <template v-if="menu==15">
        
        <tipocontratos> </tiposcontratos>
    </template>
    <template v-if="menu==16">
        
        <controlhorarios> </controlhorarios>
    </template>

     <template v-if="menu==17">
        
        <acronimo> </acronimo>
    </template>

    <template v-if="menu==19">
        
        <unidadacademica> </unidadacademica>
    </template>
    
    <template v-if="menu==18">
        <categoria> </categoria>
    </template>

    
    

@endsection