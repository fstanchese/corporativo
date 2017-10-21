select nvl(sum(TOTAL),0) as TOTAL from (
select
  Count(LPre.PLetivoP_Id) as TOTAL, 
  LPre.PLetivoP_Id,
  HoraAula.TOXCD_Id,
  AulaTi_Id,
  DivTurma_Id,
  DivDisc_Id
from
  LPre,
  HoraAula,
  PLetivoP
where
  (
    p_O_Data1 between PLetivoP.DtInicial and PLetivoP.DtFinal
     or
    p_O_Data2 between PLetivoP.DtInicial and PLetivoP.DtFinal
   )
and
  LPre.PLetivoP_Id = PLetivoP.Id
and
  LPre.HoraAula_Id = HoraAula.Id
and
  nvl(HoraAula.DivTurma_Id,0) = nvl( p_DivTurma_Id ,0)
and
  nvl(HoraAula.DivDisc_Id,0) = nvl( p_DivDisc_Id ,0)
and
  nvl(HoraAula.AulaTi_Id,0) = nvl( p_AulaTi_Id ,0)
and
  HoraAula.TOXCD_Id = nvl( p_TOXCD_Id ,0)
group by LPre.PLetivoP_Id,HoraAula.TOXCD_Id,HoraAula.AulaTi_Id,HoraAula.DivTurma_Id,HoraAula.DivDisc_Id
)