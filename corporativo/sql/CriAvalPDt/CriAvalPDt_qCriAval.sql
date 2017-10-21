select * from (
  select
    CriAvalAp.CriAval_Id            as CRIAVAL_ID,
    to_char(DtIniCad,'dd/mm/yyyy')  as DTINICAD,
    to_char(DtTerCad,'dd/mm/yyyy')  as DTTERCAD,
    to_char(DtIniProv,'dd/mm/yyyy') as DTINIPROV,
    to_char(DtTerProv,'dd/mm/yyyy') as DTTERPROV,
    to_char(DtEntProv,'dd/mm/yyyy') as DTENTPROV
  from
    CriAvalAp
  where
  (
    CriAvalAp.PLetivo_Id  = nvl( p_PLetivo_Id ,0)
  and
    CriAvalAp.CursoNivel_Id  = nvl( p_CursoNivel_Id ,0)
  and 
    CurrXDisc_ID is null
  )
  or 
  (
    CriAvalAp.PLetivo_Id  = nvl( p_PLetivo_Id ,0)
  and
    CriAvalAp.CursoNivel_Id  = nvl( p_CursoNivel_Id ,0)
  and
    CriAvalAp.CurrXDisc_Id = nvl( p_CurrXDisc_Id ,0)
 )
  order by
    CurrXDisc_Id
  ) where rownum=1