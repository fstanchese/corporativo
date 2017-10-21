oRows ( 10000 )

oAttribute ( AlocaProf_Id
             type=number(15)
             notNull
             label=Professor
             input=text )

oAttribute ( Indice
             type=number(1)
             label=Indice
             input=text ) 

oAttribute ( Horario_01_Id
             type=number(15)
             label=Hor�rio
             recognize=4
             input=list
             query=Horario_qHorario1
             relation=aggregation ) 

oAttribute ( Horario_02_Id
             type=number(15)
             label=Hor�rio
             recognize=5
             input=list
             query=Horario_qHorario2
             relation=aggregation ) 

oAttribute ( Horario_03_Id
             type=number(15)
             label=Hor�rio
             recognize=6
             input=list
             query=Horario_qHorario3
             relation=aggregation ) 

oAttribute ( Horario_04_Id
             type=number(15)
             label=Hor�rio
             recognize=7
             input=list
             query=Horario_qHorario4
             relation=aggregation ) 

oAttribute ( Horario_05_Id
             type=number(15)
             label=Hor�rio
             recognize=8
             input=list
             query=Horario_qHorario5
             relation=aggregation ) 

oAttribute ( Horario_06_Id
             type=number(15)
             label=Hor�rio
             recognize=9
             input=list
             query=Horario_qHorario6
             relation=aggregation ) 

oAttribute ( DtInicio
             type=date
             notNull
             recognize=1
             label=(Hor�rio de Aula V�lido a partir de)
             input=text ) 

oAttribute ( DtTermino
             type=date
             label=(Hor�rio de Aula V�lido at�)
             input=text ) 

oAttribute ( Professor_Id
             type=number(15)
             label=(Professor)
             recognize=3
             input=link
             link=professor_iselprof
             relation=aggregation ) 

oAttribute ( State_Id
             notNull
             recognize=2
             type=number(15)
             label=Situa��o 
             input=list
             query=State_qGeral
             relation=aggregation ) 

oAttribute ( Finalizado
             type=string(1)
             label=finalizado
             input=text )

oCalculate ( Id
             type=number(15)
             input=hidden )

