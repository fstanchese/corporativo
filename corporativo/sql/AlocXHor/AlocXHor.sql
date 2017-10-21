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
             label=Horário
             recognize=1
             input=list
             query=Horario_qHorario1
             relation=aggregation ) 

oAttribute ( Horario_02_Id
             type=number(15)
             label=Horário
             recognize=2
             input=list
             query=Horario_qHorario2
             relation=aggregation ) 

oAttribute ( Horario_03_Id
             type=number(15)
             label=Horário
             recognize=3
             input=list
             query=Horario_qHorario3
             relation=aggregation ) 

oAttribute ( Horario_04_Id
             type=number(15)
             label=Horário
             recognize=4
             input=list
             query=Horario_qHorario4
             relation=aggregation ) 

oAttribute ( Horario_05_Id
             type=number(15)
             label=Horário
             recognize=5
             input=list
             query=Horario_qHorario5
             relation=aggregation ) 

oAttribute ( Horario_06_Id
             type=number(15)
             label=Horário
             recognize=6
             input=list
             query=Horario_qHorario6
             relation=aggregation ) 

oAttribute ( AlocaProf_Junto_Id
             type=number(15)
             input=list
             query=AlocaProf_qSincronia
             label=(e a Disciplina) )

oAttribute ( HoraAula_01_Id
             type=number(15)
             label=(Horário de Aula)
             input=list
             query=HoraAula_qGeral )

oAttribute ( HoraAula_02_Id
             type=number(15)
             label=(Horário de Aula)
             input=list
             query=HoraAula_qGeral )

oAttribute ( HoraAula_03_Id
             type=number(15)
             label=(Horário de Aula)
             input=list
             query=HoraAula_qGeral )

oAttribute ( HoraAula_04_Id
             type=number(15)
             label=(Horário de Aula)
             input=list
             query=HoraAula_qGeral )

oAttribute ( HoraAula_05_Id
             type=number(15)
             label=(Horário de Aula)
             input=list
             query=HoraAula_qGeral )

oAttribute ( HoraAula_06_Id
             type=number(15)
             label=(Horário de Aula)
             input=list
             query=HoraAula_qGeral )

oCalculate ( Id
             type=number(15)
             input=hidden )
