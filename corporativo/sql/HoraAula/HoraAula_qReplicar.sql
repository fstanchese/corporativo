select 
  TXDA.Id as TXDA_ID,
  TXDP.Id as TXDP_ID,
  TOXCD_gsRetTurma(TXDA.Id) as Turma,
  Disc.Codigo as CodDisc,
  replace(replace(horaAula_gsrecognize(horaAula.id),'Noturno - ',''),'Matutino - ','') as recognize,
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id, p_HoraAula_DtInicio ) as Prof_Ativo1,
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id, p_HoraAula_DtInicio ) as Prof_Ativo2,
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id, p_HoraAula_DtInicio ) as Prof_Ativo3,
  Admissao_gnAtivo(HoraAula.WPessoa_Prof1_Id, p_HoraAula_DtInicio ) as Prof_Ativo4,
  HoraAula.*
from
  ( 
    select 
      TOXCD.ID,
      TURMAOFE.TURMA_ID,
      CURRXDISC.DISC_ID 
    from 
      toxcd,
      turmaofe,
      currofe,
      currxdisc,
      turma
    where 
      turma.duracxci_id=currxdisc.duracxci_id
    and
      currxdisc.id=toxcd.currxdisc_id
    and
      toxcd.turmaofe_id=turmaofe.id 
    and
      turmaofe.currofe_id=currofe.id 
    and 
      turmaofe.turma_id=turma.id
    and 
      turma.id = nvl( p_Turma_Id , 0 )
    and 
      currofe.pletivo_id = nvl( p_PLetivo_Anterior_Id , 0 )
  ) TXDA,
  ( 
    select 
      TOXCD.ID,
      TURMAOFE.TURMA_ID,
      CURRXDISC.DISC_ID 
    from 
      toxcd,
      turmaofe,
      currofe,
      currxdisc,
      turma 
    where 
      turma.duracxci_id=currxdisc.duracxci_id
    and
      currxdisc.id=toxcd.currxdisc_id
    and
      toxcd.turmaofe_id=turmaofe.id 
    and
      turmaofe.currofe_id=currofe.id 
    and 
      turmaofe.turma_id=turma.id
    and 
      turma.id = nvl( p_Turma_Id , 0 )
    and 
      currofe.pletivo_id = nvl( p_PLetivo_Proximo_Id , 0 )
  ) TXDP,
  HoraAula,
  Disc
where
  p_PLetivo_Final between HoraAula.DtInicio and HoraAula.DtTermino
and
  TXDA.Disc_Id = Disc.Id
and
  TXDA.ID = HORAAULA.TOXCD_ID
and
  TXDA.Turma_Id = TXDP.Turma_Id
and
  TXDA.Disc_Id = TXDP.Disc_Id
