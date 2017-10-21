
(
select
  Id     as ID,
  '-'    as RELACIONAMENTO,
  nome   as NOME,
  codigo as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')    as CPFFORMATADO
from
  WPessoa
where
  Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  WPessoa_Id         as ID,
  'Foi confessor de' as RELACIONAMENTO,
  WPessoa.nome       as NOME,
  WPessoa.codigo     as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')     as CPFFORMATADO
from
  Parcel,
  WPessoa
where
  boleto_gntemdebito(WPessoa.Id) > 0
  and
  WPessoa.Id = Parcel.WPessoa_Id
  and
  Parcel.WPessoa_Confessor_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  WPessoa_Id        as ID,
  'Foi avalista de' as RELACIONAMENTO,
  WPessoa.nome      as NOME,
  WPessoa.codigo    as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')       as CPFFORMATADO
from
  Parcel,
  WPessoa
where
  boleto_gntemdebito(WPessoa_Id) > 0
  and
  WPessoa.Id = Parcel.WPessoa_Id
  and
  Parcel.WPessoa_Avalista_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  WPessoa_Confessor_Id  as ID,
  'Teve como confessor' as RELACIONAMENTO,
  WPessoa.nome          as NOME,
  WPessoa.codigo        as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')         as CPFFORMATADO
from
  Parcel,
  WPessoa
where
  boleto_gntemdebito(WPessoa_Confessor_Id) > 0
  and
  WPessoa.Id = Parcel.WPessoa_Confessor_Id
  and
  Parcel.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  WPessoa_Avalista_Id  as ID,
  'Teve como avalista' as RELACIONAMENTO,
  WPessoa.nome         as NOME,
  WPessoa.codigo       as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')         as CPFFORMATADO
from
  Parcel,
  WPessoa
where
  boleto_gntemdebito(WPessoa_Avalista_Id) > 0
  and
  WPessoa.Id = Parcel.WPessoa_Avalista_Id
  and
  Parcel.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  WPessoa_Avalista_Id     as ID,
  'Avalista <- Confessor' as RELACIONAMENTO,
  WPessoa.nome            as NOME,
  WPessoa.codigo          as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')        as CPFFORMATADO
from
  Parcel,
  WPessoa
where
  boleto_gntemdebito(WPessoa_Avalista_Id) > 0
  and
  WPessoa.Id = Parcel.WPessoa_Avalista_Id
  and
  Parcel.WPessoa_Confessor_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  WPessoa_Confessor_Id    as ID,
  'Confessor <- Avalista' as RELACIONAMENTO,
  WPessoa.nome            as NOME,
  WPessoa.codigo          as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')       as CPFFORMATADO
from
  Parcel,
  WPessoa
where
  boleto_gntemdebito(WPessoa_Confessor_Id) > 0
  and
  WPessoa.Id = Parcel.WPessoa_Confessor_Id
  and
  Parcel.WPessoa_Avalista_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  Parente.WPessoa_Parente_Id     as ID,
  Parentesco.Nome                as RELACIONAMENTO,
  WPessoa.nome   as NOME,
  WPessoa.codigo as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')    as CPFFORMATADO
from
  Parente,
  Parentesco,
  WPessoa
where
  boleto_gntemdebito(Parente.WPessoa_Parente_Id) > 0
  and
  Parentesco.Id = Parente.Parentesco_id
  and
  WPessoa.Id = Parente.WPessoa_Parente_Id
  and
  Parente.WPessoa_Id = nvl( p_WPessoa_Id ,0)
)
union
(
select
  Parente.WPessoa_Id             as ID,
  Parentesco.Nome                as RELACIONAMENTO,
  WPessoa.nome   as NOME,
  WPessoa.codigo as RA,
  replace(to_char(wpessoa.cpf/100,'000G000G000D00'),',','-')    as CPFFORMATADO
from
  Parente,
  Parentesco,
  WPessoa
where
  boleto_gntemdebito(Parente.WPessoa_Id) > 0
  and
  Parentesco.Id = Parente.Parentesco_id
  and
  WPessoa.Id = Parente.WPessoa_Id
  and
  Parente.WPessoa_Parente_Id = nvl( p_WPessoa_Id ,0)
)
order by 2