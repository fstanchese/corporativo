select
    WPessoa.Nome as Nome,
    WPessoa_Matric.Matriculado as M,
    WPessoa_PG.Pago as P,
    to_char(Matric.Data,'dd/mm/yyyy') as Data,
    WPessoa.Codigo as RA,
    substr(TurmaOfe_gsRetCodTurma(TurmaOfe.Id),6,2) as Nucleo,
    substr(TurmaOfe_gsRetCodTurma(TurmaOfe.Id),1,8) as Turma,
    WPessoa.FoneRes as Fone_Res,
    WPessoa.FoneCom as Fone_Com,
    WPessoa.FoneCel as Fone_Cel,
    WPessoa.EMail1 as EMail_1,
    WPessoa.EMail2 as EMail_2
from
     WPessoa,
     DuracXCi,
     Turma,
     Curr,
     CurrOfe,
     TurmaOfe,
     Matric,
     (  select WPessoa.Id as WPessoa_Id, 
               'X' as Pago
        from
             WPessoa,
             DuracXCi,
             Turma,
             Curr,
             CurrOfe,
             TurmaOfe,
             Matric
         where
              WPessoa.Id = Matric.WPessoa_Id
         and
              DuracXCi.Id = Turma.DuracXCi_Id
         and
              Turma.Id = TurmaOfe.Turma_Id
         and
              Curr.Id = CurrOfe.Curr_Id
         and
              Currofe.Id = Turmaofe.CurrOfe_Id
         and
              TurmaOfe.Id = Matric.TurmaOfe_Id
         and
              Matric.Ip is not null
         and
              CurrOfe.Periodo_Id = nvl( p_Periodo_Id , 0 )
         and
              CurrOfe.Campus_Id = nvl( p_Campus_Id , 0  )
         and
             Curr.Curso_Id = nvl( p_Curso_Id , 0 )
         and
             Matric.State_Id = 3000000002002
         and
             MatricTi_Id = 8300000000001
         and
             CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id , 0 )
         and ( TurmaOfe.Id =  p_TurmaOfe_Id or p_TurmaOfe_Id is null )
    ) WPessoa_PG,
    (
         select
             WPessoa.Id as WPessoa_Id,
             'X' as Matriculado
         from
             WPessoa,
             DuracXCi,
             Turma,
             Curr,
             CurrOfe,
             TurmaOfe,
             Matric
         where
             WPessoa.Id = Matric.WPessoa_Id
         and
             DuracXCi.Id = Turma.DuracXCi_Id
         and
             Turma.Id = TurmaOfe.Turma_Id
         and
            Curr.Id = CurrOfe.Curr_Id
         and
            Currofe.Id = Turmaofe.CurrOfe_Id
         and
            TurmaOfe.Id = Matric.TurmaOfe_Id
         and
            Matric.Ip is not null
         and
            CurrOfe.Periodo_Id = nvl( p_Periodo_Id , 0 )
         and
            CurrOfe.Campus_Id = nvl( p_Campus_Id , 0 )
         and
            Curr.Curso_Id = nvl( p_Curso_Id , 0 )
         and
            MatricTi_Id = 8300000000001
         and
            CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id , 0 )
         and ( TurmaOfe.Id =  p_TurmaOfe_Id or p_TurmaOfe_Id is null )
       ) WPessoa_Matric
  where
   WPessoa.Id = Matric.WPessoa_Id
  and
   DuracXCi.Id = Turma.DuracXCi_Id
  and
   Turma.Id = TurmaOfe.Turma_Id
  and
   Curr.Id = CurrOfe.Curr_Id
  and
   Currofe.Id = Turmaofe.CurrOfe_Id
  and
   TurmaOfe.Id = Matric.TurmaOfe_Id
  and
   WPessoa.Id = WPessoa_PG.WPessoa_Id
  and
   WPessoa.Id = WPessoa_Matric.WPessoa_Id
  and
   CurrOfe.Periodo_Id = nvl( p_Periodo_Id , 0 )
  and
   Curr.Curso_Id = nvl( p_Curso_Id , 0 )
  and
   MatricTi_Id = 8300000000001
  and
   CurrOfe.Pletivo_Id = nvl( p_PLetivo_Id , 0 )
  and
   trunc(Matric.data) between p_DataInicio and p_DataFim
  and
   CurrOfe.Campus_Id = nvl( p_Campus_Id , 0 )
  and ( TurmaOfe.Id =  p_TurmaOfe_Id or p_TurmaOfe_Id is null )
order by
Turma, nome