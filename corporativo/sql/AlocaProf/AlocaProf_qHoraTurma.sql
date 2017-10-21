select sum(total) as total from (
select
  (decode(AlocXHor.horario_01_id,null,0,1)+decode(AlocXHor.horario_02_id,null,0,1)+decode(AlocXHor.horario_03_id,null,0,1)+decode(AlocXHor.horario_04_id,null,0,1)+  decode(AlocXHor.horario_05_id,null,0,1)+  decode(AlocXHor.horario_06_id,null,0,1)) as total
from
  Curr,
  Turma,
  CurrXDisc,
  Disc,
  AlocaProf,
  AlocXHor
where 
  alocxhor.indice != p_O_Numero
and
  alocaprof.aulati_id = 13300000000001
and
  Curr.Id = CurrXDisc.Curr_Id
and
  AlocaProf.State_Id = 3000000037001
and 
  CurrXDisc.Disc_Id = Disc.Id
and
  AlocaProf.CurrXDisc_Id = CurrXDisc.Id
and
  AlocaProf.Turma_Id = Turma.Id
and
  AlocaProf.Id = AlocXHor.AlocaProf_Id 
and
  AlocaProf.Id = nvl ( p_AlocaProf_Id , 0 )
)