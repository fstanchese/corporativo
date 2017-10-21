Select
  Count(*) as Total,
  TOXCD.Id,
  PLPDIV.PLetivoP_Id,
  TOXCD_gsRetDisciplina(TOXCD.Id) as Recognize
from
  TOXCD,
  DivDisc,
  ( Select PLPXDIVD.* From PLPXDIVD,DIVDISC,TOXCD where plpxdivd.divdisc_id = divdisc.id
     and DIVDISC.TOXCD_ID = TOXCD.ID AND TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0) AND PLPXDIVD.PLetivoP_Id = nvl( p_PLetivoP_Id ,0) 
  ) PLPDIV
where
  nvl(PLPDIV.PLetivoP_Id,0) = nvl( p_PLetivoP_Aux_Id ,0)
and
  PLPDIV.DivDisc_Id (+) = DivDisc.Id
and
  DivDisc.TOXCD_Id (+) = TOXCD.Id
and
  TOXCD.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
group by TOXCD.Id,PLPDIV.PLetivoP_Id
having count(*) >= p_O_Number1 and count(*) <= p_O_Number2 OR count(*) = p_O_Number3
order by Recognize