select
	PesqSAA.*
from
	PesqSAA
where
	nvl(PesqSAA.Data,PesqSAA.Dt) between p_O_Data1 and p_O_Data2
group by nvl(PesqSAA.Data,PesqSAA.Dt)