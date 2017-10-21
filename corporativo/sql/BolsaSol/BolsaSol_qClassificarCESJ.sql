select
  BolsaSolGFam_gnRendaOutMes(BolsaSol.Id)+BolsaSolGFam_gnRendaPriMes(BolsaSol.Id) as Renda,
  BolsaSol.Aluguel                                                                as Moradia,
  BolsaSol.Doenca_Id                                                              as Doenca,
  BolsaSol.WPessoa_Parente_Id                                                     as Parente,
  BolsaSolGFam_gnPessoas(BolsaSol.Id)+1                                           as GrupoFamiliar
from
  BolsaSol
where
  FIESTi_Id = p_FIESTi_Id
and
  PLetivo_Id = p_PLetivo_Id

