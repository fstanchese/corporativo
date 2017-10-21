select  
  GradAlu.Id,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' - '||PLetivo_gsRetNome(GradAlu_gnRetPLetivo(GradAlu.Id))|| ' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id)|| ' - '||CHTOTAL||' - '||CargaHoraTi_gsRecognize(CurrXDisc.CargaHoraTi_Id)||' - '||State_gsRecognize(to_number(GradAluHi.new)) || Decode(GradAlu.CriAval_Id,8600000002001,' - ' ||n5,' - ' ||n7) || ' - ' || GradAluHi.Dt as recognize,
  nvl(CurrXDisc_gsRetSerie(CurrXDisc.Id),'') as Serie
from
  GradAlu,
  CargaHoraTi,
  CurrXDisc,
  Curr,
  Disc,
  DiscCat,
  GradAluHi
where
  upper(trim(gradaluhi.col))='STATE_ID'
and
  GradAluHi.GradAlu_Id (+)= GradAlu.Id
and
  GradAlu.State_Id <> 3000000003002
and
  CurrXDisc.DiscCat_Id >= 5900000000003
and
  Disc.Id = CurrXDisc.Disc_Id
and
  CargaHoraTi.Id (+) = CurrXDisc.CargaHoraTi_Id
and
  DiscCat.Id = CurrXDisc.DiscCat_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  (
    p_Matric_Id is null
    or
    GradAlu.Matric_Id = nvl ( p_Matric_Id , 0 )
  )
and
  GradAlu.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
order by 3,GRADALUHI.DT