
def bfs(S):
	qu=[S]
	visited[int(S)-1]=True
	while qu!=[]:
		node=qu.pop(0)
		for i in graph[node]:
			if visited[int(i)-1]==False:
				qu.append(i)
				visited[int(i)-1]=True
				print(node,":",i)
		
# MAIN	
		
graph={}
visited=[]
V=int(input("enter no. of vertex"))
E=int(input("enter no. of edges"))
for i in range(V):
	graph[str(i+1)]=[]
	visited.append(False)
for i in range(E):
	u,v=input("enter start and end vertex").split()
	graph[u].append(v)                   #generate directed graph
S=input("enter starting point")
bfs(S)
